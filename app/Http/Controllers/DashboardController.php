<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('sanctum')->user();
        // if (!$user) {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }
        return view('dashboard', compact('user'));
    }
}
