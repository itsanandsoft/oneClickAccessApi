<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Machine;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Mail\PasswordReset;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected function signupValidator(array $data){
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'mac_address' => ['required'],
            'hard_disk_serial' => ['required'],
        ]);
    }
    public function signup(Request $request){
        DB::beginTransaction();
        try{
            $validator = $this->signupValidator($request->all());
            if ($validator->fails()) {
                $messages = $validator->errors()->getMessages();
                $this->json->setCode(400);
                $this->json->sendResponse(array(
                    'message' => "Validation failed.",
                    'errors' => $messages,
                ));
            }

            //$user = $this->createUser($request);
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input("password"));
            $user->mac_address = $request->input('mac_address'); // Assigning the value
            $user->hard_disk_serial = $request->input('hard_disk_serial'); // Assigning the value
            $user->is_admin = '0';
            $user->save();

            $machine = new Machine();
            $machine->user_id = $user->id;
            $machine->mac_address = $request->input('mac_address'); // Assigning the value
            $machine->hard_disk_serial = $request->input('hard_disk_serial'); // Assigning the value
            $machine->save();

            //event(new Registered($user));

            DB::commit();

            $response = array(
                'message' => "Your Account has been created.",
                'user' => $user->toArray()
            );

            $this->json->sendResponse($response);
        } catch (Exception $ex) {
            DB::rollBack();
            $this->sendException($ex);
        }
    }
    public function login(Request $request){
        try{
            $this->verifyRequiredParams(array('email','password','mac_address','hard_disk_serial'), $request);

            $user = User::where('email',$request->email)
            ->where('is_admin','<>','1')
            ->first();

            if(!empty($user)){
                if (Hash::check($request->password, $user->password)) {
                    $user->tokens()->delete();
                    if($user->hasVerifiedEmail()){
                        if(!empty($user->machines)){
                            $machine = $user->machines
                            ->where('mac_address',$request->mac_address)
                            ->where('hard_disk_serial',$request->hard_disk_serial)
                            ->first();
                            if(!empty($machine)){
                                if($machine->active == '0'){
                                    $response = array(
                                        'message' => "Login failed. Machine not active",
                                    );
                                }
                                else{
                                    $response = array(
                                        'message' => __("Login Successful."),
                                        'user' => $user->toArray(),
                                        'verified' => $user->hasVerifiedEmail(),
                                        'token' => $user->createToken('user_token')->plainTextToken,
                                    );
                                }
                            }
                            else{
                                $response = array(
                                    'message' => "Login failed. Machine not found",
                                );
                            }
                        }
                        else{
                            $response = array(
                                'message' => __("Login failed. No machine registered"),
                            );
                        }
                    }
                    else{
                        $response = array(
                            'message' => __("Account not approved"),
                        );
                    }
                }
                else{
                    $response = array(
                        'message' => __("Incorrect Password"),
                    );
                }
            }
            else{
                $response = array(
                    'message' => __("Login failed. User not found"),
                );
            }

            $this->json->sendResponse($response);

        } catch (Exception $ex) {
            $this->sendException($ex);
        }
    }
    public function forgot(Request $request){
        $this->verifyRequiredParams(array('email'), $request);
        DB::beginTransaction();
        try{
            try{
                $this->validate($request, [
                    'email' => 'required|email:rfc,dns',
                ]);
            } catch (\Exception $ex) {
                $validator = $ex->validator;
                $this->sendValidatorResponse($validator, 400);
            }
            $user = User::where("email", $request->input("email"))
                    ->first();
            if(empty($user)){
                $this->json->setCode(400);
                $this->json->sendResponse(array(
                    'message' => array(
                        'email' => "Invalid Email."
                    ),
                ));
            }

            $user->verification_code = rand(100000, 999999);
            $user->save();

            try{
                Mail::to($user->email)->send(
                    new PasswordReset($user)
                );
            } catch (\Exception $ex) {
                $this->sendException($ex);
            }
            DB::commit();
            $this->json->sendResponse(array(
                'message' => "Success"
            ));
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->sendException($ex);
        }
    }
    public function reset(Request $request){
        $this->verifyRequiredParams(array('email', 'code', 'password'), $request);
        DB::beginTransaction();
        try{
            try{
                $this->validate($request, [
                    'email' => 'required|email',
                    'code' => 'required',
                    'password' => 'required|string|min:6',
                ]);
            } catch (\Exception $ex) {
                $validator = $ex->validator;
                $this->sendValidatorResponse($validator, 400);
            }
            $user = User::where("email", $request->input("email"))->first();
            if(empty($user)){
                $this->json->setCode(400);
                $this->json->sendResponse(array(
                    'message' => array(
                        'email' => "Invalid Email or Password."
                    ),
                ));
            }
            $code = $request->input("code");
            if ($code != $user->verification_code){
                $this->json->setCode(400);
                $this->json->sendResponse(array(
                    'message' => array(
                        'email' => "Invalid Verification Code."
                    ),
                ));
            }

            $user->password = Hash::make($request->input("password"));
            $user->verification_code = '';
            $user->save();

            $response = array(
                'message' => __("Your Password has been updated."),
            );

            DB::commit();
            $this->json->sendResponse($response);
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->sendException($ex);
        }
    }
    protected function createUser(Request $request){
        $data = $request->all();

        $machine = Machine::where('mac_address',$data['mac_address'])
        ->where('hard_disk_serial',$data['hard_disk_serial'])
        ->first();
        if(!empty($machine)){
            $response = array(
                'message' => "Validation failed.",
                'errors' => [
                    'mac_address' => [
                        "Mac Address already assigned."
                    ]
                ],
            );
            $this->json->setCode(400);
            $this->json->sendResponse($response);
            return;
        }

        $user = User::create([
            'name' => '',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_admin' => 0,
        ]);
        $machine = Machine::create([
            'user_id' => $user->id,
            'mac_address' => $data['mac_address'],
            'hard_disk_serial' => $data['hard_disk_serial'],
            'machine' => isset($data['user_agent'])?$data['user_agent']:'windows',
        ]);

        return $user;
    }
    public function getAllMachines(Request $request){

        $user = Auth::user();
        if(empty($user[0])){
            if(!empty($user->machines)){
                $machines = $user->machines;
                $this->json->setCode(200);
                $this->json->sendResponse(array(
                    'machines' => $machines,
                ));
            }
            else{
                $this->json->setCode(404);
                $this->json->sendResponse(array(
                    'body' => 'not found',
                ));
            }
        }
        $this->json->setCode(404);
        $this->json->sendResponse(array(
            'body' => 'not found',
        ));
    }
}
