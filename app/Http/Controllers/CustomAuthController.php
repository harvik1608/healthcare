<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('sign_in');
    }

    public function submit_signin(Request $request)
    {
        $post = $request->all();
        $response = Http::post('http://localhost/healthcare/public/api/login', [
            'email' => $post['email'],
            'password' => $post['password'],
        ]);
        $res = $response->json();
        if($res['status'] == 200) {
            $user = User::where('email', $post['email'])->first();
            Auth::login($user); 
            return redirect("dashboard");
        } else {
            session()->flash('error', $res['message']);
            return redirect("sign-in");
        }
    }

    public function sign_up()
    {
        return view('sign_up');
    }

    public function submit_signup(Request $request)
    {
        try {
            $post = $request->all();
            $response = Http::post('http://localhost/healthcare/public/api/register', [
                'name' => $post['name'],
                'phone' => $post['phone'],
                'email' => $post['email'],
                'password' => $post['password'],
            ]);
            $res = $response->json();
            if($res['status'] == 201) {
                $user = User::where('email', $post['email'])->first();
                Auth::login($user); 
                return redirect("dashboard");
            } else {
                session()->flash('error', $res['message']);
                return redirect("sign-up");
            }
        } catch(Exception $e) {
            return response()->json(["status" => "error","message" => $e->getMessage()]);
        }
    }

    public function logout()
    {
        $response = Http::get('http://localhost/healthcare/public/api/logout');
        return redirect("sign-in");  
    }
}
