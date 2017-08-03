<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyek_Anggota extends Model
{
    protected $table = 'proyek_anggota';

    protected $fillable = [
        'id', 'kode_proyek', 'nama_proyek', 'id_pegawai'
    ];
}
