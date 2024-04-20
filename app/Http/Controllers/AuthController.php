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

        if(Auth()->attempt($data)){
            $user = Auth::user();
            if($user->role === 'admin') {
                return redirect()->route('dashboard_admin');
            }elseif($user->role === 'petugas'){
                return redirect()->route('dashboard_petugas');
            }
        }else{
            return redirect()->route('/');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('/');
    }
}
