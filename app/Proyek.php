<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    protected $table = 'proyek';

    protected $primaryKey = 'kode_proyek';

    protected $fillable = [
        'kode_proyek', 'nama_proyek', 'pemilik_proyek', 'deskripsi_proyek', 'tanggal_mulai', 'tanggal_target_selesai', 'tanggal_realisasi'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
