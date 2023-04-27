<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Classes\Json;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $json = null;
    protected $_statusCode = array(
        'email_not_verified' => 401,
        'validation_fail' => 400,
        'no_content' => 204,
        'parameter_missing' => 400,
        'unauthorized' => 401,
        'auth_fail' => 401,
        'not_approved' => 401,
        'internal_server_error' => 500,
        'invalid_password' => 400,
    );
    public function __construct() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: *');
        date_default_timezone_set('UTC');
        $this->init();
    }
    public function init(){
        //set_time_limit(60);
        //ini_set('xdebug.max_nesting_level', 500);
        $this->json = new Json();
    }
    public function sendException($ex){
        $this->json->setCode(500);
        $this->json->sendResponse(array(
            'message' => $ex->getMessage(),
            'errorTrace' => $ex->getTraceAsString()
        ));
    }
    public function sendValidatorResponse($validator,$code){
        $this->json->setCode($code);
        $this->json->sendResponse(array(
            'message' => $validator,
        ));
    }
    public function verifyRequiredParams($required_fields, Request $request = null) {
        $error = false;
        $error_fields = "";
        if(!empty($request)){
            $request_params = $request->input();
        }else{
            $request_params = $this->getParams();
        }
        foreach ($required_fields as $field) {
            if(isset($request_params[$field]) && is_array($request_params[$field])){
                if(empty($request_params[$field])){
                    $error = true;
                    $error_fields .= $field . ', ';
                    continue;
                }
                continue;
            }
            if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
                $error = true;
                $error_fields .= $field . ', ';
            }
        }
        if ($error) {
            $message = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
            $this->json->setCode(400);
            $this->json->sendResponse(array(
                'message' => $message,
                'params' => $request_params,
            ));            
        }
    }
    public function getParams(){
        $return       = array();
        $paramSources = array('_GET', '_POST');
        if (in_array('_GET', $paramSources)
            && isset($_GET)
            && is_array($_GET)
        ) {
            $return += $_GET;
        }
        if (in_array('_POST', $paramSources)
            && isset($_POST)
            && is_array($_POST)
        ) {
            $return += $_POST;
        }
        return $return;
    }
}
