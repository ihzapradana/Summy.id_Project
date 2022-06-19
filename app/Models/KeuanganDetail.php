<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeuanganDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function keuangan()
    {
        return $this->belongsTo(Keuangan::class, 'keuangan_id', 'id');
    }
}
