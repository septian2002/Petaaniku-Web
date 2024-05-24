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
        Schema::create('posting', function (Blueprint $table) {
            $table->bigIncrements('id_post');
            $table->unsignedBigInteger('id_user'); // Gunakan unsignedBigInteger karena itu adalah tipe yang sesuai dengan bigIncrements
            $table->foreign('id_user')->references('id_user')->on('users');
            $table->string('tanaman');
            $table->integer('luas_tanah');
            $table->text('deskripsi_hasil_panen');
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
        Schema::dropIfExists('postings');
    }
};
