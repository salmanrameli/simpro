<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

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
