<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Log;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

//    protected function authenticated(Request $request, $user)
//    {
//        /*
//         * Melakukan redirect user ke halaman yang sesuai dengan jabatan.
//         * Log mencatat kegiatan login user.
//         */
//        if($request->jabatan_id == '1')
//        {
//            $log = new Log();
//
//            $log->id_pegawai = $user;
//            $log->data = "login";
//            $log->save();
//
//            return redirect()->route('administrator.index');
//        }
//        else if($request->jabatan_id == '2')
//        {
//            $log = new Log();
//
//            $log->id_pegawai = $user;
//            $log->data = "login";
//            $log->save();
//
//            return redirect()->route('kadiv.index');
//        }
//        else if($request->jabatan_id == '3')
//        {
//            $log = new Log();
//
//            $log->id_pegawai = $user;
//            $log->data = "login";
//            $log->save();
//
//            return redirect()->route('pegawai.index');
//        }
//    }

    public function username()
    {
        return 'id';
    }

//    /**
//     * Where to redirect users after login.
//     *
//     * @var string
//     */
    protected $redirectTo = '/proyek';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
