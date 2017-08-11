<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password', 'alamat', 'telepon', 'jabatan_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function kegiatan()
    {
        return $this->hasMany('App\Kegiatan', 'id_pemilik_kegiatan', 'id');
    }

//    public function jabatan()
//    {
//        return $this->belongsTo('App\Jabatan', 'id');
//    }

//    public function jabatan()
//    {
//        return $this
//            ->belongsToMany('App\Jabatan')
//            ->withTimestamps();
//    }
//
//    public function authorizeRoles($roles)
//    {
//        if ($this->hasAnyRole($roles)) {
//            return true;
//        }
//        abort(401, 'This action is unauthorized.');
//    }
//    public function hasAnyRole($roles)
//    {
//        if (is_array($roles)) {
//            foreach ($roles as $role) {
//                if ($this->hasRole($role)) {
//                    return true;
//                }
//            }
//        } else {
//            if ($this->hasRole($roles)) {
//                return true;
//            }
//        }
//        return false;
//    }
//    public function hasRole($role)
//    {
//        if ($this->roles()->where(‘name’, $role)->first()) {
//            return true;
//        }
//        return false;
//    }
}
