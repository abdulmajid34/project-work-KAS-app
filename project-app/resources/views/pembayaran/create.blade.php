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
                            <a href="{{ route('pembayaran') }}">List Pembayaran</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Form Tambah Pembayaran
                        </li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Tambah Data Pembayaran</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('pembayaran.store') }}" method="post">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-4">
                                <label class="form-label">List Siswa</label>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ $error }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="close"></button>
                                            </div>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="col-md-8">
                                <select name="siswa_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                    <option value="" selected disabled>Pilih Siswa</option>
                                    @foreach ($list_siswa as $list)
                                        <option value="{{ $list->id }}"
                                            {{ old('siswa_id') == $list->id ? 'selected' : '' }}>
                                            {{ $list->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('siswa_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tanggal Pembayaran</label>
                            </div>
                            <div class="col-md-8">
                                <input type="date" class="form-control @error('tanggal_pembayaran') is-invalid @enderror"
                                    name="tanggal_pembayaran" min="{{ date('Y-m-d') }}" required>
                                @error('tanggal_pembayaran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Jumlah</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-select" name="jumlah" id="formSelect">
                                    <option selected>Pilih Jumlah Uang</option>
                                    <option value="2000">Rp. 2.000</option>
                                    <option value="3000">Rp. 3.000</option>
                                    <option value="4000">Rp. 4.000</option>
                                    <option value="5000">Rp. 5.000</option>
                                    <option value="10000">Rp. 10.000</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status Pembayaran</label>
                            </div>
                            <div class="col-md-8">
                                <select name="status_pembayaran" class="form-select" aria-label="Default select example">
                                    <option selected>Pilih Status Pembayaran</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="inputTextArea">Deskripsi</label>
                            </div>
                            <div class="col-md-8">
                                <textarea class="form-control" name="deskripsi" placeholder="ketik pesan disini..." id="inputTextArea" cols="30"
                                    rows="10"></textarea>
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
                                <a href="{{ route('pembayaran') }}" class="btn btn-secondary">
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
