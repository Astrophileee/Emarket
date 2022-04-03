<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';
    protected $keyType = 'string';
    protected $guarded = ['id'];

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class);
    }
}
