<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthController extends Controller
{

    public function register(Request $request) {
        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password); // Password must be hashed

        // Register data was submited
        $register = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        // Check if register was success
        if($register) {
            return  response()->json([
                'success' => true,
                'message' => 'Register Success',
                'data' => $register
            ], 201);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Register Failed'
            ], 400);
        }
    }

    public function login(Request $request) {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();

        // Check if the inputed password match with hashed password in database
        if(Hash::check($password, $user->password)) {
            $api_token = base64_encode(Str::random(40)); // Generating token with random string

            // Updateing user api_token
            $user->update([
                'api_token' => $api_token
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Login Success',
                'data' => [
                    'user' => $user,
                    'api_token' => $api_token
                ]
                ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Login Failed',
                'data' => ''
            ], 400);
        }
    }

     
}
