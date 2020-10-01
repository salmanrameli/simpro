<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('id', 'password');

        $user = User::where('id', $request->id)->first();

        if (Auth::attempt($credentials)) {
            /*
             * Melakukan redirect user ke halaman yang sesuai dengan jabatan.
             */
            if($user->jabatan_id == '1')
            {
                return redirect()->route('administrator.index');
            }
            else if($user->jabatan_id == '2')
            {
                return redirect()->route('kegiatan.index');
            }
            else if($user->jabatan_id == '3')
            {
                return redirect()->route('kegiatan.index');
            }
        }
    }
}
