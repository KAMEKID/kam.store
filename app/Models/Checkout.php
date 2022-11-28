<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $fillable =[
        'nama_produk', 'harga', 'jumlah', 'total', 'alamat', 'id_transaksi'
    ];
}
