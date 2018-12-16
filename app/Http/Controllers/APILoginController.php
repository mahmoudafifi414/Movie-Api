<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class APILoginController extends Controller
{
    public function login(Request $request)
    {
        $errors = [];
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            $errors[] = $validator->errors();
            return response()->json(['errors' => $errors]);
        }
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                array_push($errors, 'invalid email and password');
                return response()->json(['errors' => $errors, 'code' => 401]);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'invalid email or password', 'code' => 500]);
        }
        return response()->json(['data' => ['token' => $token, 'userData' => Auth::user()]]);
    }

    public function logout(Request $request)
    {
        JWTAuth::invalidate($request->token);
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
}