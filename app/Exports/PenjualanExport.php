<?php

namespace App\Exports;

use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenjualanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $penjualan = Penjualan::all();
        $detail = DetailPenjualan::all();

        $data = [];
        foreach ($penjualan as $item) {
            foreach ($detail as $det) {
                if ($item->id == $det->penjualan_id) {
                    $data[] = [
                        'nama_pelanggan' => $item->pelanggan->nm_pelanggan,
                        'alamat_pelanggan' => $item->pelanggan->alamat,
                        'no_telp_pelanggan' => $item->pelanggan->no_telp,
                        'nama_produk' => $det->produk->nm_produk,
                        'harga' => $det->produk->harga,
                        'jumlah_produk' => $det->jml_produk,
                        'total_harga' => $det->produk->harga * $det->jml_produk,
                        'created_at' => $item->created_at->setTimeZone('Asia/Jakarta')->format('Y-m-d H:i A')
                    ];
                }
            }
        }
        return collect($data);
    }


    public function headings(): array
    {
        return [
            'Nama Pelanggan',
            'Alamat',
            'No Handphone',
            'Nama Produk',
            'Harga Satuan',
            'Jumlah',
            'Total Harga',
            'Tgl Transaksi'
        ];
    }
}
