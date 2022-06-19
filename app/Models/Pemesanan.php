<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->hasOne(Produk::class, 'id', 'id_product');
    }
}
