<?php

use Illuminate\Database\Seeder;
use App\Jabatan;
use App\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan_administrator = Jabatan::where('nama_jabatan', 'administrator')->first();
        $jabatan_kadiv = Jabatan::where('nama_jabatan', 'kepala divisi')->first();
        $jabatan_pegawai = Jabatan::where('nama_jabatan', 'pegawai')->first();

        $faker = Faker::create();

        $pegawai = new User();
        $pegawai->id = '1';
        $pegawai->name = 'Alpha';
        $pegawai->email = $faker->companyEmail;
        $pegawai->password = bcrypt('user');
        $pegawai->alamat = $faker->address;
        $pegawai->telepon = $faker->phoneNumber;
        $pegawai->jabatan_id = '1';
        $pegawai->save();
//        $pegawai->jabatan()->attach($jabatan_administrator);

//        $pegawai = new User();
//        $pegawai->id = '2';
//        $pegawai->name = 'Bravo';
//        $pegawai->email = $faker->companyEmail;
//        $pegawai->password = bcrypt('user');
//        $pegawai->alamat = $faker->address;
//        $pegawai->telepon = $faker->phoneNumber;
//        $pegawai->jabatan_id = '2';
//        $pegawai->save();
////        $pegawai->jabatan()->attach($jabatan_kadiv);
//
//        $pegawai = new User();
//        $pegawai->id = '3';
//        $pegawai->name = 'Charlie';
//        $pegawai->email = $faker->companyEmail;
//        $pegawai->password = bcrypt('user');
//        $pegawai->alamat = $faker->address;
//        $pegawai->telepon = $faker->phoneNumber;
//        $pegawai->jabatan_id = '3';
//        $pegawai->save();
////        $pegawai->jabatan()->attach($jabatan_pegawai);
//
//        $pegawai = new User();
//        $pegawai->id = '4';
//        $pegawai->name = 'Delta';
//        $pegawai->email = $faker->companyEmail;
//        $pegawai->password = bcrypt('user');
//        $pegawai->alamat = $faker->address;
//        $pegawai->telepon = $faker->phoneNumber;
//        $pegawai->jabatan_id = '3';
//        $pegawai->save();
////        $pegawai->jabatan()->attach($jabatan_pegawai);
//
//        $pegawai = new User();
//        $pegawai->id = '5';
//        $pegawai->name = 'Echo';
//        $pegawai->email = $faker->companyEmail;
//        $pegawai->password = bcrypt('user');
//        $pegawai->alamat = $faker->address;
//        $pegawai->telepon = $faker->phoneNumber;
//        $pegawai->jabatan_id = '3';
//        $pegawai->save();
////        $pegawai->jabatan()->attach($jabatan_pegawai);
//
//        $pegawai = new User();
//        $pegawai->id = '6';
//        $pegawai->name = 'Foxtrot';
//        $pegawai->email = $faker->companyEmail;
//        $pegawai->password = bcrypt('user');
//        $pegawai->alamat = $faker->address;
//        $pegawai->telepon = $faker->phoneNumber;
//        $pegawai->jabatan_id = '3';
//        $pegawai->save();
////        $pegawai->jabatan()->attach($jabatan_pegawai);
//
//        $pegawai = new User();
//        $pegawai->id = '7';
//        $pegawai->name = 'Golf';
//        $pegawai->email = $faker->companyEmail;
//        $pegawai->password = bcrypt('user');
//        $pegawai->alamat = $faker->address;
//        $pegawai->telepon = $faker->phoneNumber;
//        $pegawai->jabatan_id = '3';
//        $pegawai->save();
////        $pegawai->jabatan()->attach($jabatan_pegawai);
//
//        $pegawai = new User();
//        $pegawai->id = '8';
//        $pegawai->name = 'Hotel';
//        $pegawai->email = $faker->companyEmail;
//        $pegawai->password = bcrypt('user');
//        $pegawai->alamat = $faker->address;
//        $pegawai->telepon = $faker->phoneNumber;
//        $pegawai->jabatan_id = '3';
//        $pegawai->save();
////        $pegawai->jabatan()->attach($jabatan_pegawai);
//
//        $pegawai = new User();
//        $pegawai->id = '9';
//        $pegawai->name = 'India';
//        $pegawai->email = $faker->companyEmail;
//        $pegawai->password = bcrypt('user');
//        $pegawai->alamat = $faker->address;
//        $pegawai->telepon = $faker->phoneNumber;
//        $pegawai->jabatan_id = '3';
//        $pegawai->save();
////        $pegawai->jabatan()->attach($jabatan_pegawai);
//
//        $pegawai = new User();
//        $pegawai->id = '10';
//        $pegawai->name = 'Juliet';
//        $pegawai->email = $faker->companyEmail;
//        $pegawai->password = bcrypt('user');
//        $pegawai->alamat = $faker->address;
//        $pegawai->telepon = $faker->phoneNumber;
//        $pegawai->jabatan_id = '3';
//        $pegawai->save();
////        $pegawai->jabatan()->attach($jabatan_pegawai);
//
//        $pegawai = new User();
//        $pegawai->id = '11';
//        $pegawai->name = 'Kilo';
//        $pegawai->email = $faker->companyEmail;
//        $pegawai->password = bcrypt('user');
//        $pegawai->alamat = $faker->address;
//        $pegawai->telepon = $faker->phoneNumber;
//        $pegawai->jabatan_id = '3';
//        $pegawai->save();
////        $pegawai->jabatan()->attach($jabatan_pegawai);
//
//        $pegawai = new User();
//        $pegawai->id = '12';
//        $pegawai->name = 'Lima';
//        $pegawai->email = $faker->companyEmail;
//        $pegawai->password = bcrypt('user');
//        $pegawai->alamat = $faker->address;
//        $pegawai->telepon = $faker->phoneNumber;
//        $pegawai->jabatan_id = '3';
//        $pegawai->save();
////        $pegawai->jabatan()->attach($jabatan_pegawai);
//
//        $pegawai = new User();
//        $pegawai->id = '13';
//        $pegawai->name = 'Mike';
//        $pegawai->email = $faker->companyEmail;
//        $pegawai->password = bcrypt('user');
//        $pegawai->alamat = $faker->address;
//        $pegawai->telepon = $faker->phoneNumber;
//        $pegawai->jabatan_id = '3';
//        $pegawai->save();
////        $pegawai->jabatan()->attach($jabatan_pegawai);
//
//        $pegawai = new User();
//        $pegawai->id = '14';
//        $pegawai->name = 'November';
//        $pegawai->email = $faker->companyEmail;
//        $pegawai->password = bcrypt('user');
//        $pegawai->alamat = $faker->address;
//        $pegawai->telepon = $faker->phoneNumber;
//        $pegawai->jabatan_id = '3';
//        $pegawai->save();
////        $pegawai->jabatan()->attach($jabatan_pegawai);
//
//        $pegawai = new User();
//        $pegawai->id = '15';
//        $pegawai->name = 'Oscar';
//        $pegawai->email = $faker->companyEmail;
//        $pegawai->password = bcrypt('user');
//        $pegawai->alamat = $faker->address;
//        $pegawai->telepon = $faker->phoneNumber;
//        $pegawai->jabatan_id = '3';
//        $pegawai->save();
////        $pegawai->jabatan()->attach($jabatan_pegawai);
//
//        for($i=16; $i<=100; $i++)
//        {
//            $pegawai = new User();
//            $pegawai->id = $i;
//            $pegawai->name = $faker->name;
//            $pegawai->email = $faker->companyEmail;
//            $pegawai->password = bcrypt('user');
//            $pegawai->alamat = $faker->address;
//            $pegawai->telepon = $faker->phoneNumber;
//            $pegawai->jabatan_id = '3';
//            $pegawai->save();
//        }

    }

}
