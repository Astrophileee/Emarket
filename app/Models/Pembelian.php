<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';

    protected $fillable = ['kode_masuk', 'tanggal_masuk', 'total', 'pemasok_id', 'user_id'];

    public function pemasok(){
        return $this->belongsTo(Pemasok::class);
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function detailPembelian(){
        return $this->hasMany(DetailPembelian::class);
    }

    public static function get_code()
    {
        $pembelian = self::latest()->first() ?? new self();
        return 'P' . sprintf("%0". 4 . "s", (int) $pembelian->id + 1);
    }
}
