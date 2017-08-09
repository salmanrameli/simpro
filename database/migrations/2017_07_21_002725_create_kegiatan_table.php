<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_kegiatan')->unique();
            $table->string('nama_kegiatan');
            $table->string('id_pemilik_kegiatan');
            $table->text('deskripsi_kegiatan');
            $table->string('tanggal_mulai');
            $table->date('tanggal_target_selesai');
            $table->date('tanggal_realisasi');
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
        Schema::dropIfExists('kegiatan');
    }
}
