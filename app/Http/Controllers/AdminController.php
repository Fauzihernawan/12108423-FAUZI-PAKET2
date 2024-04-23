<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function index()
    {
        $produk = Produk::count();
        $user = User::count();
        $penjualan = Penjualan::count();
        return view('admin.dashboard.index', compact('produk', 'user', 'penjualan'));
    }

    public function dataPembelian()
    {
        $data = Penjualan::all();
        return view('admin.pembelian.index', compact('data'));
    }

    public function cetakPDF($id)
    {
        // Ambil data penjualan berdasarkan ID yang diberikan
        $detailPenjualan = DetailPenjualan::where('penjualan_id', $id)->get();
        $penjualan = Penjualan::find($id);
        $totalHarga = $penjualan->total_harga;
        $pelanggan = Pelanggan::find($penjualan->pelanggan_id);
        $user = auth()->user();
        $pdf = PDF::loadView('petugas.pembelian.expdf', compact('detailPenjualan', 'totalHarga', 'penjualan', 'user'));
        return $pdf->download('transaksi_pembelian_' . $id . '.pdf');
    }
}
