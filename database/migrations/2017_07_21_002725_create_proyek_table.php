<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyek', function (Blueprint $table) {
            $table->string('kode_proyek');
            $table->primary('kode_proyek');

            $table->string('nama_proyek');
            $table->string('pemilik_proyek');
            $table->text('deskripsi_proyek');
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
        Schema::dropIfExists('proyek');
    }
}
