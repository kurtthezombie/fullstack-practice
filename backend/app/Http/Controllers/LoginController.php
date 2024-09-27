<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function login (Request $request) {
        $request->validate([
            'name'      => 'required|string',
            'password'      => 'required|string',
        ]);

        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status'        => true,
                'token_type'    => 'Bearer',
                'token'         => $token,
                'user'          => $user,
                'message'       => 'Successfully logged in.',
            ], 200);
        } else {
            // Step 5: Authentication failed, return an error response
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }
    }

    public function logout(Request $request) {
        // Get the currently authenticated user
        $user = Auth::user();

        // Revoke the user's current token (this will log them out)
        $user->currentAccessToken()->delete();
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out.'
        ], 200);
    }
}
