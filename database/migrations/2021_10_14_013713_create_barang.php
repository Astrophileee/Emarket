<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang',30);
            $table->foreignId('produk_id')->constrained('produk')->cascadeOnUpdate();
            $table->string('nama_barang',50);
            $table->string('satuan',10);
            $table->double('harga_jual');
            $table->integer('stok');
            $table->integer('ditarik')->default(0);
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
