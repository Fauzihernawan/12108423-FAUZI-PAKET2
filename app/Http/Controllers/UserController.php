<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user =  User::get();
        return view('admin.user.index', compact('user'));
    }

    public function tambah()
    {
        return view('admin.user.form');
    }

    public function simpanUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password)
        ];

        User::create($data);
        return redirect()->route('user')->with('success', 'Berhasil Tambah User');
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('user')->with('failed', 'Data tidak ada');
        }
        return view('admin.user.form', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validata = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'name' => $validata['name'],
            'email' => $validata['email'],
            'role' => $validata['role'],
        ];

        if ($request->has('password')) {
            $data['password'] = bcrypt($validata['password']);
        }
  
        User::find($id)->update($data);
        return redirect()->route('user')->with('success', 'Berhasil Update');
    }

    public function hapus($id)
    {
        User::find($id)->delete();
        return redirect()->route('user')->with('success', 'Berhasil Hapus');
    }
}
