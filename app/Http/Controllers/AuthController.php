<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|unique:admins,email',
            'password' => 'required|string|confirmed|min:6'
        ]);

        $admin = Admin::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $admin->createToken('tokenku')->plainTextToken;

        $response = [
            'admin' => $admin,
            'token' => $token,
            'message' => 'Registrasi berhasil'
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        //Check Email
        $admin = Admin::where('email', $fields['email'])->first();

        //Check Password
        if (!$admin || !Hash::check($fields['password'], $admin->password)) {
            return response([
                'message' => 'unauthorized'
            ], 401);
        }

        $token = $admin->createToken('tokenku')->plainTextToken;

        $response = [
            'admin' => $admin,
            'token' => $token,
            'message' => 'Admin berhasil login'
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Admin logged out'
        ];
    }


    public function user_register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('tokenku')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
            'message' => 'Registrasi berhasil'
        ];

        return response($response, 201);
    }

    public function user_login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        //Check Email
        $user = User::where('email', $fields['email'])->first();

        //Check Password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'unauthorized'
            ], 401);
        }

        $token = $user->createToken('tokenku')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
            'message' => 'User berhasil login'
        ];

        return response($response, 201);
    }

    public function user_logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'User logged out'
        ];
    }
}