<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $table = 'detail_penjualans';
    protected $guarded = ['id'];

    public function Produk()
    {
        return $this->belongsTo(Produk::class);     
    }

    public function Penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
    
}
