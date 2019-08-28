<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    protected $fillable = [
        'penjualan_id',
        'mobil_id',
        'harga',
        'jumlah',
        'subtotal'
    ];

    public function mobil ()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id');
    }
}
