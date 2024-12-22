<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function register(Request $request) {

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password
        ]);

        $token = $user->createToken($request->name);
        return response()->json(["data" => $user, "token" => $token->plainTextToken], 201);
    }

    function login (Request $request) {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return "username or password incorrect";
        }
        $token = $user->createToken($user->name);
        return response()->json(["token" => $token->plainTextToken], 200);
    }

    function logout(Request $request){
        $request->user()->tokens()->delete();
        return [
            "message" => "you are logged out"
        ];
    }
}
