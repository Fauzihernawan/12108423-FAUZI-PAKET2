@extends('layouts.index')

@section('title', 'Data Produk')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard_admin') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Data Produk</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('formproduk') }}" class="btn btn-primary mb-3">Tambah Produk</a>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Gambar</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produk as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nm_produk }}</td>
                                            <td>Rp. {{ number_format($item->harga) }}</td>
                                            <td>{{ $item->stok }}</td>
                                            <td>
                                                <img src="{{ asset($item->gambar) }}" width="60px" alt="">
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target="#updateStokModal{{ $item->id }}">
                                                    <i class="fas fa-sync"></i>
                                                </button>
                                                <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-primary"><i
                                                        class="fas fa-pen"></i></a>
                                                <a href="{{ route('produk.hapus', $item->id) }}" class="btn btn-danger"><i
                                                        class="fas fa-trash"></i></a>

                                                <!-- Button trigger modal -->
                                                    
                                                <!-- Modal -->
                                                <div class="modal fade" id="updateStokModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="updateStokModalLabel{{ $item->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="updateStokModalLabel{{ $item->id }}"> Update Stok Produk:  {{ $item->nm_produk }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('stok.update', $item->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <div class="form-group">
                                                                        <label for="stok{{ $item->id }}">Stok Baru</label>
                                                                        <input type="number" class="form-control" id="stok{{ $item->id }}" name="stok" value="{{ $item->stok }}" required>
                                                                    </div>
                                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
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
    </section>
@endsection
