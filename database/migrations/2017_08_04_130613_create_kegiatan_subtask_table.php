<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatanSubtaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_subtask', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_kegiatan');
            $table->string('id_pembuat');
            $table->string('nama_subtask');
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
        Schema::dropIfExists('kegiatan_subtask');
    }
}
