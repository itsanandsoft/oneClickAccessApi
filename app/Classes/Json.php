<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Classes;

class Json {
    protected $body;
    protected $code = 200;
    protected $logFileName;
    protected $logFile;
    public function __construct() {
//        $this->logFileName = Stars_PATH_TMP.DS."log".DS."data.log";
    }
    public function setCode($code){
        $this->code = $code;
    }
    public function setBody($body){
        $this->body = $body;
    }
    public function sendResponse($body = null){
        if(!is_null($body)){
            $this->body = $body;
        }
        http_response_code($this->code);
        header('Content-Type: application/json');
        $response = array(
            'status_code' => $this->code,
            'body' => $this->body
        );
        echo json_encode($response);
        $this->logData($response);
        exit;
        
    }
    public function sendRawResponse($body = null){
        if(!is_null($body)){
            $this->body = $body;
        }
        http_response_code($this->code);
        header('Content-Type: application/json');
        echo @json_encode($this->body);
        exit;
        
    }
    public function logData($data = array()){
        return;
        try {
            if(!file_exists($this->logFileName) && is_writable(dirname($this->logFileName))){
                $this->logFile = fopen($this->logFileName, "a");
            }else{
                $this->logFile = fopen($this->logFileName, "a");
            }
            if(!empty($data)){
                $text = "Response Vars\n";
                $text .= json_encode($data);                
                fwrite($this->logFile, $text . "\n\n"); 
            }
            if(!empty($_POST)){
                $text = "POST Vars\n";
                foreach ($_POST as $key=>$value) {
                    if(is_array($value)){
                        foreach ($value as $key => $value){
                            $text .= "$key = $value, ";
                        }
                    }else{
                        $text .= "$key = $value, ";
                    }
                   
                }
                fwrite($this->logFile, $text . "\n\n"); 
            }
            if(!empty($_GET)){
                $text = "GET Vars\n";
                foreach ($_POST as $key=>$value) {
                    if(!is_array($value)){
                        $text .= "$key = $value, ";
                    }
                }
                fwrite($this->logFile, $text . "\n\n"); 
            }
            fclose($this->logFile);
            
        } catch (Exception $ex) {
//            throw $ex;
        }
    }
}
