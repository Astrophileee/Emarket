<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    use HasFactory;
    protected $table = 'detail_pembelian';
    protected $guarded = ['id'];

    public function pembelian(){
        return $this->belongsTo(Pembelian::class);
    }

    public function barang() {
        return $this->belongsTo(Barang::class);
    }

}
