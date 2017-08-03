<?php

namespace App\Http\Controllers\Auth;

use App\Jabatan;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

//    public function redirectPath()
//    {
//        $uid = Auth::user()->getAuthIdentifier();
//
//        if($uid == '1')
//        {
//            return redirect('home');
//        }
//        else{
//            return redirect('/');
//        }
//    }
//
//    protected function authenticated(Request $request, $user)
//    {
//        if($user->hasRole('administrator'))
//        {
//            return redirect('home');
//        }
//        else{
//            return redirect('/');
//        }
//    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'id' => 'required|string|max:255',
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
//        return User::create([
//            'id' => $data['id'],
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => bcrypt($data['password']),
//            'alamat' => $data['alamat'],
//            'telepon' => $data['telepon']
//        ]);

        $user = new User();
        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->alamat = $data['alamat'];
        $user->telepon = $data['telepon'];
        $user->save();

        $user->jabatan()->attach(Jabatan::where('nama_jabatan', 'administrator')->first());

        return $user;
    }
}
