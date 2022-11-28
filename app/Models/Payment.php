<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable =[
        'tanggal_transaksi', 'waktu_transaksi', 'id_transaksi', 'rekening_tujuan', 'nama_penerima', 'bank_tujuan', 'nama_pengirim', 'nominal'
    ];
}
