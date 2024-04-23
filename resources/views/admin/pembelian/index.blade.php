@extends('layouts.index')

@section('title', '| Data Pembelian')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Pembelian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard_admin') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Data Penjualan</li>
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
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th style="width: 300px">Nama Pelanggan</th>
                                        <th style="width: 400px" class="text-center">Tanggal Penjualan</th>
                                        <th style="width: 400px" class="text-center">Total Harga</th>
                                        <th style="width: 400px" class="text-center">Dibuat Oleh</th>
                                        <th style="width: 50px;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->pelanggan->nm_pelanggan }}</td>
                                            <td class="text-center">{{ $item->tgl_penjualan }}</td>
                                            <td class="text-center">Rp. {{ number_format($item->total_harga) }}</td>
                                            <td class="text-center">{{ $item->user->name }}</td>
                                            <td>
                                                {{-- <button type="button" class="btn btn-info" data-toggle="modal"
                                                    data-target="#exampleModal{{ $item->id }}">
                                                    <i class="fas fa-sync"></i>
                                                </button> --}}
                                                <a href="{{ route('cetakPDF', $item->id) }}" class="btn btn-info"><i class="fa fa-download"></i></a>
                                                {{-- modal --}}
                                                {{-- <div class="modal fade" tabindex="-1" role="dialog"
                                                    id="exampleModal{{ $item->id }}">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Detail Sale {{ $item->id }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($penjualan->pelanggan)
                                                                    <div>Nama Pelanggan:{{ $penjualan->pelanggan->nm_pelanggan }}</div>
                                                                    <div>Alamat: {{ $penjualan->pelanggan->alamat }}</div>
                                                                    <div>No. Telepon: {{ $penjualan->pelanggan->no_telp }}
                                                                    </div>
                                                                @endif
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Nama Produk</th>
                                                                            <th scope="col">Banyak Barang</th>
                                                                            <th scope="col">Harga</th>
                                                                            <th scope="col">Subtotal</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($detailPenjualan as $index => $item)
                                                                            <tr>
                                                                                <td>{{ $index + 1 }}</td>
                                                                                <td>{{ $item->produk->nm_produk }}</td>
                                                                                <td>{{ $item->jml_produk }}</td>
                                                                                <td>Rp
                                                                                    {{ number_format($item->produk->harga) }}
                                                                                </td>
                                                                                <td>Rp {{ number_format($item->subtotal) }}
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                <div>Total Harga:
                                                                    Rp{{ number_format($data->total_harga, 0, ',' . '.') }}
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer bg-whitesmoke br">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">
                                                                Close
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div> --}}
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
