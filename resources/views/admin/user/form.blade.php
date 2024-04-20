@extends('layouts.index')

@section('title', '| Form User')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Form User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard_petugas') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user') }}">User</a></li>
                        <li class="breadcrumb-item active">Form User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary">
                    <form action="{{ isset($user) ? route('user.update', $user->id) : route('user.simpan') }}"
                        method="POST">
                        @csrf
                        @if (isset($user))
                            @method('PATCH')
                        @endif
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Tambah user" value="{{ isset($user) ? $user->name : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukan Email" value="{{ isset($user) ? $user->email : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <div class="col-md-14">
                                    <select name="role" class="form-control shadow-none form-control-line ">
                                        <option value="" disabled selected>Pilih peran...</option>
                                        <option value="admin"
                                            {{ isset($user) && $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="petugas"
                                            {{ isset($user) && $user->role == 'petugas' ? 'selected' : '' }}>Petugas
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Masukkan Password" value="{{ isset($user) ? $user->password : '' }}">
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('user') }}" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
