<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeri', function (Blueprint $table) {
            $table->bigIncrements('id_galeri');
            $table->unsignedBigInteger('id_produk'); // Gunakan unsignedBigInteger karena itu adalah tipe yang sesuai dengan bigIncrements
            $table->foreign('id_produk')->references('id_produk')->on('produk'); // Tambahkan referensi ke kolom 'id_produk' di tabel 'produk'
            $table->text('url_galeri');
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
        Schema::dropIfExists('galeris');
    }
};
