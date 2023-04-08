<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Mail\PasswordReset;

class UserController extends Controller
{
    protected function signupValidator(array $data){
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'mac_address' => ['required', 'string','unique:users'],
            'hard_disk_serial' => ['required', 'string'],
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
                    'message' => __("Validation failed."),
                    'errors' => $messages,
                ));
            }
            
            $user = $this->createUser($request);
            //event(new Registered($user));

            DB::commit();
            
            $response = array(
                'message' => __("Your Account has been created."),
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
            // ->where('mac_address',$request->mac_address)
            // ->where('hard_disk_serial',$request->hard_disk_serial)
            ->get();
            
            if(count($user) > 0){
                //echo "<pre>";print_r($user[0]->mac_address);exit;
                if($user[0]->mac_address == $request->mac_address && $user[0]->hard_disk_serial == $request->hard_disk_serial){
                    $response = array(
                        'message' => __("Login Successful."),
                        'user' => $user->toArray(),
                        'verified' => $user[0]->hasVerifiedEmail(),
                    );
                }
                else{
                    $response = array(
                        'message' => __("Login failed. Limit exceed or invalid machine"),
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
                    'email' => 'required|email:rfc,dns',
                    'code' => 'required',
                    'password' => 'required|string|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
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
      
        $user = User::create([
            'name' => '',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'mac_address' => $data['mac_address'],
            'hard_disk_serial' => $data['hard_disk_serial'],
        ]);

        return $user;
    }
    public function verifyUser(Request $request){
        $this->verifyRequiredParams(array('id'), $request);
        DB::beginTransaction();
        try{
            $user = User::where("id", $request->input("id"))->first();
            if(empty($user)){
                $this->json->setCode(400);
                $this->json->sendResponse(array(
                    'message' => array(
                        'email' => "Invalid User."
                    ),
                ));
            }
            
            $current_date_time = Carbon::now()->toDateTimeString();
            
            $user->email_verified_at = $current_date_time;
            $user->save();
            
            $response = array(
                'message' => __("Verification Complete"),
            );
            
            DB::commit();
            $this->json->sendResponse($response);
        } catch (\Exception $ex) {
            DB::rollBack();
            $this->sendException($ex);
        }
    }
}
