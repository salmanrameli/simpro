<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';

    protected $fillable = [
        'kode_kegiatan', 'nama_kegiatan', 'id_pemilik_kegiatan', 'deskripsi_kegiatan', 'tanggal_mulai', 'tanggal_target_selesai', 'tanggal_realisasi'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id');
    }
}
