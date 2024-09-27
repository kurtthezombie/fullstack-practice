<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|string",
            'email' => "required|email",
            'password' => "required|string"
        ]);
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            return response()->json([
                'message' => "User account registered successfully!",
                'status' => true,
            ], 201);

        } catch (Exception $error) {
            return response()->json([
                'message' => "User registration failed: {$error}",
                'status' => false,
            ], 500);

        }
    }
}
