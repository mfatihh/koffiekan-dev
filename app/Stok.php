<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table = 'stoks';
    protected $fillable = [
        'kode_produk',
        'no_invoice',
        'nama',
        'masuk',
        'keluar',
        'sisa_stok',
        'sisa_stok_kiloan',
        'keterangan'
    ];

    protected $dates = ['created_at'];

}
