<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $keyType = 'string';
    protected $guarded = ['id'];

    public function produk() {
        return $this->belongsTo(produk::class);
    }
    public function pembelian() {
        return $this->hasMany(DetailPembelian::class);
    }
    public function penjualan() {
        return $this->hasMany(DetailPenjualan::class);
    }


    public static function get_code()
    {

        $barang = self::latest()->first() ?? new self();
        return 'B' . sprintf("%0". 8 . "s", (int) $barang->id + 1);
    }

}
