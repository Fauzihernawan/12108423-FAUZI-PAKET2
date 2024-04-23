<?php

namespace App\Http\Controllers;

use App\Exports\PelangganExport;
use App\Exports\PenjualanExport;
use App\Models\User;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PetugasController extends Controller
{
    public function index()
    {
        $user = User::get();
        return view('petugas.dashboard.index', compact('user'));
    }

    public function dataProduk()
    {
        $produk = Produk::all();
        return view('petugas.produk.index', compact('produk'));
    }

    public function dataPembelian()
    {
        $data = Penjualan::all();
        return view('petugas.pembelian.index', compact('data'));
    }

    public function tambahPembelian()
    {
        $produk = Produk::all();
        return view('petugas.pembelian.form', compact('produk'));
    }

    public function simpanPembelian(Request $request)
    {
        // Validate input
        $request->validate([
            'nm_pelanggan' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'tgl_penjualan' => 'required',
            'produk_id.*' => 'required|distinct',
            'jml_produk.*' => 'required|numeric|min:1',
            'pembayaran' => 'required|numeric|min:0',
        ]);

        // Create new customer
        $pelanggan = Pelanggan::create([
            'nm_pelanggan' => $request->nm_pelanggan,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        $currentDateTime = Carbon::now();
        // Calculate total price
        $totalPrice = 0;
        $penjualan = null; // Initialize $penjualan here
        foreach ($request->produk_id as $key => $produkID) {
            if (isset($request->jml_produk[$key])) {
                $jumlahBeli = $request->jml_produk[$key];
                $produk = Produk::findOrFail($produkID);
                $subtotal = $produk->harga * $jumlahBeli;
                $totalPrice += $subtotal;

                // Create or update detail penjualan
                if (!$penjualan) {
                    // Create new sale if not yet created
                    $penjualan = Penjualan::create([
                        'user_id' => Auth::user()->id,
                        'pelanggan_id' => $pelanggan->id,
                        'tgl_penjualan' => $request->tgl_penjualan,
                        'pembayaran' => $request->pembayaran,
                        'kembalian' => $request->pembayaran - $totalPrice,
                        'total_harga' => $totalPrice,
                    ]);
                }
                DetailPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id' => $produkID,
                    'jml_produk' => $jumlahBeli,
                    'subtotal' => $subtotal,
                ]);

                // Update product stock
                $produk->stok -= $jumlahBeli;
                $produk->save();
            }
        }

        // Calculate change
        $kembalian = $request->pembayaran - $totalPrice;

        // Update total price and change in the sale record
        $penjualan->update(['total_harga' => $totalPrice, 'kembalian' => $kembalian]);
        $penjualanId = $penjualan->id;
        // Redirect with parameters
        return redirect()->route('pembelian')->with(['pembayaran' => $request->pembayaran, 'kembalian' => $kembalian])->with('pdf', $penjualanId);
    }

    public function exportPDF($id)
    {
        $penjualan = Penjualan::findOrFail($id); // Menggunakan findOrFail untuk menemukan penjualan berdasarkan ID
        $detailPenjualan = DetailPenjualan::where('penjualan_id', $id)->get();
        $user = auth()->user();
        $totalHarga = $detailPenjualan->sum('subtotal');
        
        // Memastikan properti pelanggan tersedia dalam $penjualan
        $pelangganNama = isset($penjualan->pelanggan) ? $penjualan->pelanggan->nm_pelanggan : '-';
        $pelangganAlamat = isset($penjualan->pelanggan) ? $penjualan->pelanggan->alamat : '-';
        $pelangganNoTelp = isset($penjualan->pelanggan) ? $penjualan->pelanggan->no_telp : '-';

        $pdf = PDF::loadView('petugas.pembelian.expdf', compact('detailPenjualan', 'totalHarga', 'penjualan', 'user', 'pelangganNama', 'pelangganAlamat', 'pelangganNoTelp'));
        return $pdf->download('transaksi_pembelian_' . $id . '.pdf');
    }

    public function cetakEXCEL()
    {

        return Excel::download(new PenjualanExport, 'Data Penjualan -  KasirBRo' .'.xlsx');
    }
}
