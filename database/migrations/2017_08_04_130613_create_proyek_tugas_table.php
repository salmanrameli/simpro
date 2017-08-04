<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyekTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyek_tugas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_proyek');
            $table->string('id_pembuat');
            $table->string('nama_tugas');
            $table->string('id_pegawai_mengerjakan')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('proyek_tugas');
    }
}
