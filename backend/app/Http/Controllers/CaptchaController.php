<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mews\Captcha\Facades\Captcha;
use Log;

class CaptchaController extends Controller
{
    /*public function reloadCaptcha() {
        $captcha = captcha_src('math');
        
        return response()->json([
            'captcha' => $captcha,
            'message' => 'Captcha generated',
        ],200);
    }
    */

    public function post(Request $request) {
        //validate captcha
        $captcha_validated = $this->validateCaptcha($request->captcha,$request->key);

        if ($captcha_validated) {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Form successfully submitted'
            ], 200);
        }
        else {
            return response()->json([
                'status' => false,
                'message' => 'Captcha incorrect or invalid.',
            ]);
        }
        

    }

    function validateCaptcha(string $captcha, string $key) {
        //$data = ['captcha' => $captcha];
        Log::info('Captcha:', ['captcha' => $captcha, 'key' => $key]);
        $rules = ['captcha' => 'required|captcha_api:'.$key.',math'];
        $validator = validator()->make(['captcha' => $captcha], $rules);
        if ($validator->fails()) {
            return false;
            /*return response()->json([
                'errors' => [
                    'captcha' => "Captcha is invalid."
                ]
            ],400);*/
        }
        else {
            return true;
        }
    }
}
