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
        Schema::create('produk', function (Blueprint $table) {
            $table->bigIncrements('id_produk');
            $table->unsignedBigInteger('id_kategori'); // Gunakan unsignedBigInteger karena itu adalah tipe yang sesuai dengan bigIncrements
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');
            $table->string('nama_produk');
            // $table->string('gambar');
            $table->text('deskripsi');
            $table->integer('harga');
            $table->integer('total_jual');
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
        Schema::dropIfExists('products');
    }
};
