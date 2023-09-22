<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            throw new \Error('Invalid credentials!', 401);
        }

        $user = User::whereId(Auth::user()->id)->first();

        $user->tokens()->delete();

        $accessToken = $user->createToken('auth_token')->plainTextToken;
        return response()->json(compact('accessToken'));
    }

    public function signup(Request $request)
    {
        $user = new User([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
        ]);

        $user->save();
    }
}
