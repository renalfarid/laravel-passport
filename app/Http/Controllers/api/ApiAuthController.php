<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{
    public function login (Request $request) {
        
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $response = array();
            if (Hash::check($request->password, $user->password)) {
                $user_data = $user;

                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $user_data->token = $token;
                $response = [$user_data];
                
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
