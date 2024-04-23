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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard_petugas') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Data Penjualan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @if (@session('pdf'))
        <a href="{{ route('exportPDF', session('pdf')) }}" id="unduhPDF" style="display: none"></a>
        <script>
            window.onload = function() {
                var link = document.getElementById('unduhPDF');
                if (link) {
                    link.click();
                }
            };
        </script>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            {{-- <a href="{{ route('kategori.tambah') }}" class="btn btn-primary mb-3">Tambah Kategori</a> --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('formPembelian') }}" class="btn btn-primary mb-3">Input Pembelian</a>
                                <a href="{{ route('exportExcel') }}" class="btn btn-primary  mb-3">Cetak Excel</a>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th style="width: 300px" class="text-center">Nama</th>
                                        <th style="width: 550px" class="text-center">Tanggal</th>
                                        <th style="width: 350px" class="text-center">Total Harga</th>
                                        <th style="width: 350px" class="text-center">Kembalian</th>
                                        <th style="width: 350px" class="text-center">Dibuat Oleh</th>
                                        <th style="width: 50px" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $item->pelanggan->nm_pelanggan }}</td>
                                            <td class="text-center">{{ $item->created_at->setTimeZone('Asia/Jakarta')->format('Y-m-d H:i A') }}</td>
                                            <td class="text-center">Rp. {{ number_format($item->total_harga) }}</td>
                                            <td class="text-center">Rp. {{ number_format($item->kembalian) }}</td>
                                            <td class="text-center">{{ $item->user->name }}</td>
                                            <td>
                                                {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailModal{{ $item->id }}">
                                                    <i class="fa fa-eye"></i>
                                                </button> --}}
                                                <a href="{{ route('exportPDF', $item->id) }}" class="btn btn-info"><i
                                                        class="fa fa-download"></i></a>
                                                {{-- modal --}}
                                                {{-- <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1">
                                                    <role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="detailModalLabel">Detail
                                                                    Penjualan {{ $item->id }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Tampilkan detail penjualan di sini -->
                                                                <p>Nama Pelanggan: {{ $item->pelanggan->nm_pelanggan }}</p>
                                                                <p>Nama Pelanggan: {{ $item->pelanggan->alamat }}</p>
                                                                <p>Nama Pelanggan: {{ $item->pelanggan->no_telp }}</p>
                                                                <p>Tanggal Penjualan: {{ $item->tgl_penjualan }}</p>
                                                                <!-- dan seterusnya sesuai dengan detail yang ingin ditampilkan -->
                                                            </div>
                                                            <table>
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Nama Produk</th>
                                                                        <th>Jumlah</th>
                                                                        <th>Harga Satuan</th>
                                                                        <th>Subtotal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($item->detailPenjualan as $detailItem)
                                                                        <tr>
                                                                       
                                                                            <td>{{ $detailItem->produk->nm_produk }}</td>
                                                                            <td>{{ $detailItem->jml_produk }}</td>
                                                                            <td>Rp {{ number_format($detailItem->produk->harga) }}</td>
                                                                            <td>Rp {{ number_format($detailItem->subtotal) }}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                    <tr class="total-row">
                                                                        <td colspan="4" style="text-align: right;">Total Harga:</td>
                                                                        <td>Rp {{ number_format($totalHarga) }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
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
