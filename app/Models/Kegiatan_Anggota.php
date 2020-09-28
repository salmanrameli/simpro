<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan_Anggota extends Model
{
    protected $table = 'kegiatan_anggota';

    protected $fillable = [
        'id', 'kode_kegiatan', 'nama_kegiatan', 'id_pegawai'
    ];
}
