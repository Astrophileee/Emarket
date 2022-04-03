<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemasok extends Model
{
    use HasFactory;
    protected $table = 'pemasok';
    protected $keyType = 'string';
    protected $guarded = ['id'];

    public static function get_code()
    {

        $pemasok = self::latest()->first() ?? new self();
        return 'S' . sprintf("%0". 4 . "s", (int) $pemasok->id + 1);
        
    }

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class);
    }
}
