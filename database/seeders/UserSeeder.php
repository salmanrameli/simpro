<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        $faker = Faker::create();

        $pegawai = new \App\Models\User();
        $pegawai->id = '1';
        $pegawai->name = $faker->name;
        $pegawai->email = $faker->companyEmail;
        $pegawai->password = bcrypt('password');
        $pegawai->alamat = $faker->address;
        $pegawai->telepon = $faker->phoneNumber;
        $pegawai->jabatan_id = '1';
        $pegawai->save();

        $pegawai = new \App\Models\User();
        $pegawai->name = $faker->name;
        $pegawai->email = $faker->companyEmail;
        $pegawai->password = bcrypt('pasword');
        $pegawai->alamat = $faker->address;
        $pegawai->telepon = $faker->phoneNumber;
        $pegawai->jabatan_id = '2';
        $pegawai->save();

        foreach (range(1, 24) as $index) {
            $pegawai = new \App\Models\User();
            $pegawai->name = $faker->name();
            $pegawai->email = $faker->companyEmail;
            $pegawai->password = bcrypt('password');
            $pegawai->alamat = $faker->address;
            $pegawai->telepon = $faker->phoneNumber;
            $pegawai->jabatan_id = '3';
            $pegawai->save();
        }
    }

}
