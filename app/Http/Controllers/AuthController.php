<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function Index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(auth()->attempt($data)){
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            }elseif ($user->role == 'petugas') {
                return redirect()->route('dashboard');
            }
        }else {
            return redirect()->route('/')->with('failed', 'gagal login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('/');
    }
}
