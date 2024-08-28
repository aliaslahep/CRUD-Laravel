<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $registerdData = $request->validate([
            'username' => 'required|max:55',
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);
    
        $user = User::create($registerdData);
    
        $accessToken = $user->createToken('authToken')->accessToken;
    
        return response(['user' => $user, 'access_token' => $accessToken], 201);
        
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        if (!auth()->attempt($loginData)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
        $user = auth()->user();
        $accessToken = $user->createToken('authToken')->accessToken;
    
        return response()->json([
            'user' => $user,
            'access_token' => $accessToken,
        ]);
    }
}