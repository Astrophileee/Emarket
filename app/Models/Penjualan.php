<?php

namespace App\Models;

use App\Models\Pelanggan;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $guarded = ['id'];

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class);
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function detailPenjualan(){
        return $this->hasMany(DetailPenjualan::class);
    }

    public static function get_code()
    {
        $penjualan = self::latest()->first() ?? new self();
        return 'F' . sprintf("%0". 8 . "s", (int) $penjualan->id + 1);
    }
}
