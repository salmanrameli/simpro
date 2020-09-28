<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan_Subtask extends Model
{
    protected $table = 'kegiatan_subtask';

    protected $fillable = [
        'id', 'kode_kegiatan', 'id_pembuat', 'nama_tugas', 'id_pegawai_mengerjakan', 'status', 'updated_at'
    ];
}
