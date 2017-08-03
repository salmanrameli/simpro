<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        /*
         * Cek jabatan dari user yang akan mengakses halaman.
         *
         * Jika jabatan user tidak sama dengan parameter yang diminta oleh routing,
         * maka permintaan akan ditolak.
         */
        $user_role = $request->user()->jabatan_id;

//        $user_role = DB::table('jabatan_user')->where('user_id', $user_id)->value('jabatan_id');

        if($user_role != $role)
        {
            $warning = "Anda tidak memiliki hak akses";

            return redirect()->back()->with('warning', $warning);
        }

        return $next($request);
    }
}
