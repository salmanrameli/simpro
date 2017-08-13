<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumen';

    protected $fillable = [
        'id', 'kode_kegiatan', 'id_subtask', 'id_pegawai', 'judul', 'dokumen', 'tipe'
    ];
}
