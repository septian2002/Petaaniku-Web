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
        Schema::create('keranjang', function (Blueprint $table) {
            $table->bigIncrements('id_keranjang');
            $table->unsignedBigInteger('id_user'); // Gunakan unsignedBigInteger karena itu adalah tipe yang sesuai dengan bigIncrements
            $table->foreign('id_user')->references('id_user')->on('users');
            // $table->string('nama_produk');
            $table->integer('jumlah_produk');
            // $table->integer('harga_produk');
            $table->unsignedBigInteger('id_produk'); // Gunakan unsignedBigInteger karena itu adalah tipe yang sesuai dengan bigIncrements
            $table->foreign('id_produk')->references('id_produk')->on('produk');
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
        Schema::dropIfExists('keranjangs');
    }
};
