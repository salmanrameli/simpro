<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumen';

    protected $fillable = [
        'id', 'nama_dokumen', 'dokumen', 'kode_proyek', 'id_pegawai', 'tipe'
    ];
}
