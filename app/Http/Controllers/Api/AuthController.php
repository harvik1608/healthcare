<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $count = User::where("email",$request->email)->count();
        if($count == 0) {
            $count = User::where("phone",$request->phone)->count();
            if($count == 0) {
                $user = User::create([
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'phone'    => $request->phone,
                    'password' => Hash::make($request->password),
                ]);
                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'status' => 201,
                    'message' => 'User registered successfully',
                    'user'    => $user,
                    'token'   => $token,
                    'href' => route('user.dashboard')
                ]);
            } else {
                return response()->json(['status' => 400,'message' => "Mobile no. already exist."]);
            }
        } else {
            return response()->json(['status' => 400,'message' => "Email already exist."]);
        }
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['status' => 400,'message' => "Invalid Credentials."]);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['status' => 200,'message' => 'Login successful','user' => $user,'token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}
