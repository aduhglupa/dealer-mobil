<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $fillable = ['nama', 'harga', 'stok', 'is_active'];
}
