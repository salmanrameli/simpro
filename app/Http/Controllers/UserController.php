<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function home()
    {
        $user_id = Auth::id();

        $role = DB::table('users')->where('id', $user_id)->value('jabatan_id');

        $users = DB::table('users')->where('deleted_at', null)->orderBy('name')->paginate(20);

        if($role == 1)
        {
            return view('user.index')
                ->with('users', $users);
        }

        return redirect()->back()->with('warning', 'Anda tidak memiliki hak akses');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $role = DB::table('users')->where('id', $user_id)->value('jabatan_id');

        $message = \session('message');

        if($role == '1')
        {
            Session::flash('message', $message);

            return redirect()->route('administrator.home');
        }
        else if($role == '2')
        {
            Session::flash('message', $message);

            return redirect()->route('kegiatan.index');
        }
        else if($role == '3')
        {
            Session::flash('message', $message);

            return redirect()->route('kegiatan.index');
        }
        else
        {
            return view('welcome');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_request = $request->id;

        $result = DB::table('users')->where('id', $id_request)->value('id');

        if($result == null)
        {
            $this->validate($request, [
                'id' => 'required',
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|confirmed',
                'alamat' => 'required',
                'telepon' => 'required',
                'jabatan' => 'required'
            ]);

            $user = new User();

            $user->id = $request->id;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->alamat = $request->alamat;
            $user->telepon = $request->telepon;
            $user->jabatan_id = $request->jabatan;

            $user->save();

            $log = new Log();
            $log->id_pegawai = Auth::id();
            $log->data = "mendaftarkan akun " . $id_request;
            $log->save();

            $message = "Akun berhasil didaftarkan";

            return redirect()->route('home')->with('message', $message);
        }
        else
        {
            $warning = "ID " . $id_request . " sudah terdaftar. Gunakan nomor ID lain";

            return redirect()->back()->with('warning', $warning);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = DB::table('users')->where('id', $id)->value('jabatan_id');

        if($role == '1')
        {
            return redirect()->action('AdministratorController@show', ['id' => $id]);
        }
        else if($role == '2')
        {
            return redirect()->action('KadivController@show', ['id' => $id]);
        }
        else if($role == '3')
        {
            return redirect()->action('PegawaiController@show', ['id' => $id]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = DB::table('users')->where('id', $id)->value('jabatan_id');

        if($role == '1')
        {
            return redirect()->action('AdministratorController@edit', ['id' => $id]);
        }
        else if($role == '2')
        {
            return redirect()->action('KadivController@edit', ['id' => $id]);
        }
        else if($role == '3')
        {
            return redirect()->action('PegawaiController@edit', ['id' => $id]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorFail($id);

        $user->delete();

        Session::flash('message', 'Akun berhasil dihapus');

        return redirect()->action('UserController@home');
    }

    public function ubah_password($id)
    {
        $role = DB::table('users')->where('id', $id)->value('jabatan_id');

        if($role == '1')
        {
            return redirect()->action('AdministratorController@ubah_password', ['id' => $id]);
        }
        else if($role == '2')
        {
            return redirect()->action('KadivController@ubah_password', ['id' => $id]);
        }
        else if($role == '3')
        {
            return redirect()->action('PegawaiController@ubah_password', ['id' => $id]);
        }
    }

    public function simpan_password(Request $request)
    {
        /*
         * Menyimpan perubahan password.
         * Dilakukan pengecekan apakah hash password yang lama sesuai dengan yang tersimpan di database.
         */
        $this->validate($request, [
            'old' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = User::find(Auth::id());

        $hashedPassword = $user->password;

        if (Hash::check($request->old, $hashedPassword)) {
            //Change the password
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            $message = "Password berhasil diubah";

            return redirect()->route('home')->with('message', $message);
        }

        $message = "Password gagal diubah";

        return redirect()->route('home')->with('warning', $message);
    }

    public function user_detail($id)
    {
        $user = User::findorFail($id);

        return view('user.detail')->with('user', $user);
    }
}
