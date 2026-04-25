<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'string', 'min:6'],
            ]);


            if (! Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Invalid Credentials',
                ], 404);
            }

            $user = Auth::user();

            info(["user" => $user]);

            $token = $user->createToken('auth_token')->plainTextToken;
            
            info(['token' => $token]);


            return response()->json([
                'message' => 'Logged In Successfully',
                'token' => $token,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }

    }

    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:50'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'string', 'min:6'],
            ]);

            // convert into hash
            $validated['password'] = Hash::make($validated['password']);

            User::create($validated);

            return response()->json([
                'message' => 'User created Successfully',
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }
    }
}
