<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    protected $fillable = [
        'nm_produk',
        'harga',
        'stok',
        'gambar'
    ];

    public function detailItem()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
}
