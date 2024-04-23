@extends('layouts.index')

@section('title', '| Form Pembelian')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Form Pembelian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard_petugas') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pembelian') }}">Pembelian</a></li>
                        <li class="breadcrumb-item active">Form Pembelian</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-primary">
                    <form action="{{ route('pembelian.simpan') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nm_pelanggan">Nama Pelanggan</label>
                                            <input type="text" class="form-control" id="nm_pelanggan"
                                                name="nm_pelanggan">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat">
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telp">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="no_telp" name="no_telp">
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_penjualan">Tanggal</label>
                                            <input type="datetime-local" class="form-control" id="tgl_penjualan" name="tgl_penjualan">
                                        </div>                                        
                                    </div>
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold">Detail Produk</h6>
                                    </div>
                                    <div class="card-body saleForm">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="produk_id">Produk</label>
                                                    <select class="form-control produk-dropdown" name="produk_id[]"
                                                        required>
                                                        <option value="">Pilih Produk</option>
                                                        @foreach ($produk as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nm_produk }} - Rp.
                                                                {{ number_format($item->harga) }} 
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="total_harga">Jumlah Produk</label>
                                                    <input type="text" class="form-control jml_produk"
                                                        name="jml_produk[]" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="addSaleItem">Tambah Produk</button>
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Pembayaran</h6>
                                    </div>
                                    <div class="card-footer">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="total_seluruh">Total Seluruh (Rp)</label>
                                                <input type="text" class="form-control" id="total_seluruh"
                                                    name="total_harga" readonly>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="bayar">Uang Pembayaran (Rp)</label>
                                                <input type="text" class="form-control" id="bayar" name="pembayaran"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="kembalian">Kembalian (Rp)</label>
                                                <input type="text" class="form-control" id="kembalian" readonly
                                                    name="kembalian">
                                                @if (session('error'))
                                                    <span class="text-danger">{{ session('error') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script>
        document.getElementById('addSaleItem').addEventListener('click', function() {
            var saleForm = document.querySelector('.saleForm'); // Temukan elemen terkait
            var newSaleItem = saleForm.cloneNode(true);
            saleForm.parentNode.insertBefore(newSaleItem, this);
            // Panggil fungsi untuk menambahkan event listener baru pada elemen baru
            initializeNewSaleItem(newSaleItem);
            updateTotalAndKembalian(); // Update total dan kembalian saat menambahkan item baru
        });

        // Fungsi untuk menginisialisasi event listener pada elemen baru
        function initializeNewSaleItem(newSaleItem) {
            newSaleItem.querySelector('.produk-dropdown').addEventListener('change', function() {
                updateTotalAndKembalian();
            });
            newSaleItem.querySelector('.jml_produk').addEventListener('input', function() {
                updateTotalAndKembalian();
            });
        }

        function updateTotalAndKembalian() {
            var total = 0;
            var quantities = document.querySelectorAll('.jml_produk');
            var prices = <?php echo json_encode($produk->pluck('harga', 'id')); ?>;
            quantities.forEach(function(quantityInput) {
                var productId = quantityInput.closest('.row').querySelector('select').value;
                var price = prices[productId];
                var quantity = parseFloat(quantityInput.value);
                total += price * quantity;
            });
            document.getElementById('total_seluruh').value = formatCurrency(total.toFixed(2));
            var pembayaran = parseFloat(document.getElementById('bayar').value);
            var kembalian = pembayaran - total;
            document.getElementById('kembalian').value = formatCurrency(kembalian.toFixed(2));
        }

        document.addEventListener('input', function(event) {
            if (event.target && event.target.classList.contains('jml_produk')) {
                updateTotalAndKembalian();
            }
        });

        document.getElementById('bayar').addEventListener('input', function() {
            updateTotalAndKembalian();
        });

        window.onload = function() {
            updateTotalAndKembalian();
        };

        function formatCurrency(amount) {
            // Menggunakan regex untuk memisahkan angka ribuan
            return 'Rp ' + amount.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
        }
    </script>

@endsection
