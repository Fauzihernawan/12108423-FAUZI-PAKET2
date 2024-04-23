<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggans';
    protected $fillable = [
        'nm_pelanggan',
        'alamat',
        'no_telp'
    ];

    public function Penjualan(){
        return $this->hasMany(Penjualan::class, 'pelanggan_id');
    }
}
