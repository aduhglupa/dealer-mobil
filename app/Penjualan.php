<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = ['nama_pembeli', 'email_pembeli', 'telp_pembeli'];

    public function details ()
    {
        return $this->hasMany(PenjualanDetail::class, 'penjualan_id');
    }
}
