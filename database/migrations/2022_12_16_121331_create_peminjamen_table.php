<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pengguna_id')->unsigned();
            $table->foreign('pengguna_id')->references('id')->on('penggunas')->onDelete('restrict');
            $table->bigInteger('alat_id')->unsigned();
            $table->foreign('alat_id')->references('id')->on('alats')->onDelete('restrict');
            $table->bigInteger('petugas_id')->unsigned();
            $table->foreign('petugas_id')->references('id')->on('petugas')->onDelete('restrict');
            $table->string('tanggal_peminjaman');
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
        Schema::dropIfExists('peminjamen');
    }
}
