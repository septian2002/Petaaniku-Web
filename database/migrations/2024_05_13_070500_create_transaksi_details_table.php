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
        Schema::create('transaksi_details', function (Blueprint $table) {
            $table->bigIncrements('id_td');
            $table->unsignedBigInteger('id_tt'); // Gunakan unsignedBigInteger karena itu adalah tipe yang sesuai dengan bigIncrements
            $table->foreign('id_tt')->references('id_tt')->on('transaksi_total');
            $table->unsignedBigInteger('id_produk'); // Gunakan unsignedBigInteger karena itu adalah tipe yang sesuai dengan bigIncrements
            $table->foreign('id_produk')->references('id_produk')->on('produk');
            $table->string('nama_produk');
            $table->integer('harga');
            $table->integer('jumlah');
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
        Schema::dropIfExists('transaksi_details');
    }
};
