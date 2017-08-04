<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyek_Tugas extends Model
{
    protected $table = 'proyek_tugas';

    protected $fillable = [
        'id', 'kode_proyek', 'id_pembuat', 'nama_tugas', 'id_pegawai_mengerjakan', 'status', 'updated_at'
    ];
}
