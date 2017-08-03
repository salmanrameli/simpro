<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyek_Progress extends Model
{
    protected $table = 'proyek_progress';

    protected $fillable = [
        'id', 'kode_proyek', 'id_pegawai', 'kegiatan', 'progress', 'keterangan'
    ];

}
