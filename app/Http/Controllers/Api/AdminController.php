<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Mail\PasswordReset;

class AdminController extends Controller
{
    public function login(Request $request){
        try{
            $this->verifyRequiredParams(array('email','password'), $request);

            $user = User::where('email',$request->email)->get();

            if(count($user) > 0){
                if (Hash::check($request->password, $user[0]->password)) {
                    $user[0]->tokens()->delete();
                    if(!empty($user[0]->is_admin)){
                        $this->json->setCode(200);
                        $response = array(
                            'message' => __("Login Successful."),
                            'user' => $user->toArray(),
                            'verified' => $user[0]->hasVerifiedEmail(),
                            'token' => $user[0]->createToken('admin_token')->plainTextToken,
                        );
                    }
                    else{
                        $this->json->setCode(400);
                        $response = array(
                            'message' => __("Login Faild. User not an admin")
                        );
                    }
                }
                else{
                    $this->json->setCode(400);
                    $response = array(
                        'message' => __("Incorrect Password"),
                    );
                }
            }
            else{
                $this->json->setCode(400);
                $response = array(
                    'message' => __("Login failed. User not found "),
                );
            }
            $this->json->sendResponse($response);

        } catch (Exception $ex) {
            $this->sendException($ex);
        }
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
    public function getAllUsers(Request $request){
        $users = User::where('is_admin', '<>', '1')->get();
        $response = array(
            'data' => $users,
        );
        $this->json->sendResponse($response);
    }
    public function getUserFiles(Request $request){
        $users = User::where('is_admin', '<>', '1')->get();
        foreach($users as $user){
            $user['files'] = $user->files;
            $user['machines'] = $user->machines;
        }
        $response = array(
            'data' => $users,
        );
        $this->json->sendResponse($response);
    }
    public function uploadFile(Request $request){
        $user = User::where('id',$request->id)->first();
        $file = new File;
        $file->data = $request->json;
        $user->files()->save($file);
        $user['files'] = $user->files;
        $this->json->setCode(200);
        $response = array(
            'data' => $user,
        );
        $this->json->sendResponse($response);
    }
}
