<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function detail(){
        return $this->hasMany(KeuanganDetail::class, 'keuangan_id', 'id');
    }
}

