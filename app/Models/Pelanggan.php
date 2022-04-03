<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';
    protected $keyType = 'string';
    protected $guarded = ['id'];

    public function penjualan() {
        return $this->hasMany(Penjualan::class);
    }
    public function pengajuan() {
        return $this->hasMany(Pengajuan::class);
    }

    public static function get_code()
    {

        $pelanggan = self::latest()->first() ?? new self();
        return 'M' . sprintf("%0". 4 . "s", (int) $pelanggan->id + 1);
    }
}
