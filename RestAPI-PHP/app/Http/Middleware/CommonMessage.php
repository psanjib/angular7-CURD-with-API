<?php

namespace App\Http\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use App\Http\Helper\Common;

class CommonMessage extends Common{

    protected function BadIp() {
        $result = array(
            'code' => 501,
            'msg' => "invalid IP address supplied",
            'response' => NULL
        );
        return $result;
    }

    protected function UnauthorisedRequest() {
        $result = array(
            'code' => 500,
            'msg' => "Service not authorised",
            'response' => NULL
        );
        return $result;
    }

    public static function ThmeCopied() {
        $result = array(
            'code' => 200,
            'msg' => "Theme Copied Successfully",
            'response' => NULL
        );
        return $result;
    }

    public static function BadRequest() {
        $result = array(
            'code' => 400,
            'msg' => "invalid request message parameters, or deceptive request routing",
            'response' => NULL
        );
        return $result;
    }

    public static function Success($msg='') {
        $result = array(
            'code' => 200,
            'msg' => "$msg saved successfully!",
            'response' => NULL
        );
        return $result;
    }
    
    public static function GlobalSuccess($msg='',$response) {
        $result = array(
            'code' => 200,
            'msg' => $msg,
            'response' => $response
        );
        return $result;
    }
    
    public static function GlobalFail($msg='',$response) {
        $result = array(
            'code' => 500,
            'msg' => $msg,
            'response' => $response
        );
        return $result;
    }
    
    
    public static function Failed($msg='') {
        $result = array(
            'code' => 500,
            'msg' => "$msg save failed",
            'response' => NULL
        );
        return $result;
    }
    
    public static function SomethingWrong() {
        $result = array(
            'code' => 402,
            'msg' => "Something went worng!!",
            'response' => NULL
        );
        return $result;
    }

    protected function BadRequestMethod() {
        $result = array(
            'code' => 400,
            'msg' => "Bad Request!! please check reuested parameters",
            'response' => NULL
        );
        return $result;
    }

    

    public static function InvalidTheme() {
        $result = array(
            'code' => 500,
            'msg' => "Invalid Theme Requested.",
            'response' => NULL
        );
        return $result;
    }

}
