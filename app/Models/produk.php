<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $keyType = 'string';
    protected $fillable = ['nama_produk'];

    public function Barang() {
        return $this->hasMany(Barang::class);
    }

    public function canDelete(){
        return !$this->Barang()->exists();
    }
}
