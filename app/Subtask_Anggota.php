<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtask_Anggota extends Model
{
    protected $table = 'subtask_anggota';

    protected $fillable = [
        'id', 'kode_kegiatan', 'id_pegawai'
    ];
}
