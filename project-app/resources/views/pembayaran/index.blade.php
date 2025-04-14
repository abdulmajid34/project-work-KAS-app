@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5>List Pembayaran</h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="d-flex"></div>
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <form action="{{ route('pembayaran') }}" method="GET" id="filterForm">
                                <label class="form-label">Filter Tanggal</label>
                                <input type="date" class="form-control @error('filter_date') is-invalid @enderror"
                                    name="filter_date" value="{{ request('filter_date', date('Y-m-d')) }}"
                                    onchange="this.form.submit()">
                            </form>
                        </div>
                        <div class="col-md-8 justify-content-end">
                            @if (Auth::user()->role !== 'siswa')
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-icon btn-light-primary" data-bs-toggle="modal"
                                        data-bs-target="#import_file">
                                        <i class="bi bi-box-arrow-in-down"></i>
                                    </button>

                                    <button class="btn mx-2 btn-icon btn-light-primary" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Download File">
                                        <i class="bi bi-upload"></i>
                                    </button>

                                    <a href="{{ route('pembayaran.create') }}" class="btn btn-icon btn-light-primary"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
                                        <i class="bi bi-plus-lg py-2"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th class="text-center">NIM</th>
                                    <th class="text-center">Tgl Pembayaran</th>
                                    <th>Jumlah</th>
                                    <th class="text-center">Status Pembayaran</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_pembayaran as $list)
                                    <tr>
                                        <td>{{ $list->siswa->nama_lengkap }}</td>
                                        <td>{{ $list->siswa->nim }}</td>
                                        <td class="text-center">{{ $list->tanggal_pembayaran }}</td>
                                        <td>Rp {{ number_format($list->jumlah, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            @if ($list->status_pembayaran == 1)
                                                <span class="badge bg-success">Sudah Bayar</span>
                                            @else
                                                <span class="badge bg-danger">Belum Bayar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">

                                                <form action="{{ route('pembayaran.destroy', $list->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-icon btn-light-danger"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="import_file" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">
                        Import File Data Pembayaran Kas
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" class="dropzone dz-clickable">
                        <div class="dz-default dz-message">
                            <button type="button" class="dz-button">
                                drop files here to upload
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </button>
                    <button type="submit" class="btn btn-primary mx-2">
                        <i class="bi bi-save"></i>
                        Simpan
                    </button>

                </div>
            </div>
        </div>
    </div>
@endsection
