<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualans';
    protected $fillable = [
        'produk_id',
        'total_harga',
        'tgl_penjualan'
    ];

    public function Produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function DetailPenjualan()
    {
        return $this->hasOne(DetailPenjualan::class);
    }

    public function Pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
