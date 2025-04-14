@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('user') }}">List User</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Form Tambah User
                        </li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Tambah Data User</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="post">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-4">
                                <label class="form-label">Username</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" autofocus required value="{{ old('username') }}" placeholder="Username">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nama Akun</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control @error('nama_akun') is-invalid @enderror"
                                    name="nama_akun" autofocus required placeholder="nama_akun">
                                @error('nama_akun')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Password</label>
                            </div>
                            <div class="col-md-8">
                                <input type="password" id="floatingPassword"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="password"
                                    name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Role</label>
                            </div>
                            <div class="col-md-8">
                                <select name="role" class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="admin">Admin</option>
                                    <option value="ketua_kelas">Ketua Kelas</option>
                                    <option value="bendahara">Bendahara</option>
                                    <option value="siswa">Siswa</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status</label>
                            </div>
                            <div class="col-md-8">
                                <select name="status" class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button class="btn btn-warning">
                                    <i class="bi bi-box-arrow-in-down"></i>
                                    Import
                                </button>
                                <button type="submit" class="btn btn-primary mx-2">
                                    <i class="bi bi-save"></i>
                                    Simpan
                                </button>
                                <a href="{{ route('user') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i>
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
