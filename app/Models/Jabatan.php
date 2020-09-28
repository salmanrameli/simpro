<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';

    protected $fillable = [
        'id', 'nama_jabatan'
    ];

//    public function users()
//    {
//        return $this
//            ->belongsToMany('App\User')
//            ->withTimestamps();
//    }

//    public function users()
//    {
//        return $this->belongsToMany('App\User', 'users');
//    }
}
