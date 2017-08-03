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

        $pegawai = new User();
        $pegawai->id = '2';
        $pegawai->name = 'Bravo';
        $pegawai->email = $faker->companyEmail;
        $pegawai->password = bcrypt('user');
        $pegawai->alamat = $faker->address;
        $pegawai->telepon = $faker->phoneNumber;
        $pegawai->jabatan_id = '2';
        $pegawai->save();
//        $pegawai->jabatan()->attach($jabatan_kadiv);

        $pegawai = new User();
        $pegawai->id = '3';
        $pegawai->name = 'Charlie';
        $pegawai->email = $faker->companyEmail;
        $pegawai->password = bcrypt('user');
        $pegawai->alamat = $faker->address;
        $pegawai->telepon = $faker->phoneNumber;
        $pegawai->jabatan_id = '3';
        $pegawai->save();
//        $pegawai->jabatan()->attach($jabatan_pegawai);

        $pegawai = new User();
        $pegawai->id = '4';
        $pegawai->name = 'Delta';
        $pegawai->email = $faker->companyEmail;
        $pegawai->password = bcrypt('user');
        $pegawai->alamat = $faker->address;
        $pegawai->telepon = $faker->phoneNumber;
        $pegawai->jabatan_id = '3';
        $pegawai->save();
//        $pegawai->jabatan()->attach($jabatan_pegawai);

        $pegawai = new User();
        $pegawai->id = '5';
        $pegawai->name = 'Echo';
        $pegawai->email = $faker->companyEmail;
        $pegawai->password = bcrypt('user');
        $pegawai->alamat = $faker->address;
        $pegawai->telepon = $faker->phoneNumber;
        $pegawai->jabatan_id = '3';
        $pegawai->save();
//        $pegawai->jabatan()->attach($jabatan_pegawai);

        $pegawai = new User();
        $pegawai->id = '6';
        $pegawai->name = 'Foxtrot';
        $pegawai->email = $faker->companyEmail;
        $pegawai->password = bcrypt('user');
        $pegawai->alamat = $faker->address;
        $pegawai->telepon = $faker->phoneNumber;
        $pegawai->jabatan_id = '3';
        $pegawai->save();
//        $pegawai->jabatan()->attach($jabatan_pegawai);

        $pegawai = new User();
        $pegawai->id = '7';
        $pegawai->name = 'Golf';
        $pegawai->email = $faker->companyEmail;
        $pegawai->password = bcrypt('user');
        $pegawai->alamat = $faker->address;
        $pegawai->telepon = $faker->phoneNumber;
        $pegawai->jabatan_id = '3';
        $pegawai->save();
//        $pegawai->jabatan()->attach($jabatan_pegawai);

        $pegawai = new User();
        $pegawai->id = '8';
        $pegawai->name = 'Hotel';
        $pegawai->email = $faker->companyEmail;
        $pegawai->password = bcrypt('user');
        $pegawai->alamat = $faker->address;
        $pegawai->telepon = $faker->phoneNumber;
        $pegawai->jabatan_id = '3';
        $pegawai->save();
//        $pegawai->jabatan()->attach($jabatan_pegawai);

        $pegawai = new User();
        $pegawai->id = '9';
        $pegawai->name = 'India';
        $pegawai->email = $faker->companyEmail;
        $pegawai->password = bcrypt('user');
        $pegawai->alamat = $faker->address;
        $pegawai->telepon = $faker->phoneNumber;
        $pegawai->jabatan_id = '3';
        $pegawai->save();
//        $pegawai->jabatan()->attach($jabatan_pegawai);

        $pegawai = new User();
        $pegawai->id = '10';
        $pegawai->name = 'Juliet';
        $pegawai->email = $faker->companyEmail;
        $pegawai->password = bcrypt('user');
        $pegawai->alamat = $faker->address;
        $pegawai->telepon = $faker->phoneNumber;
        $pegawai->jabatan_id = '3';
        $pegawai->save();
//        $pegawai->jabatan()->attach($jabatan_pegawai);

        $pegawai = new User();
        $pegawai->id = '11';
        $pegawai->name = 'Kilo';
        $pegawai->email = $faker->companyEmail;
        $pegawai->password = bcrypt('user');
        $pegawai->alamat = $faker->address;
        $pegawai->telepon = $faker->phoneNumber;
        $pegawai->jabatan_id = '3';
        $pegawai->save();
//        $pegawai->jabatan()->attach($jabatan_pegawai);

        $pegawai = new User();
        $pegawai->id = '12';
        $pegawai->name = 'Lima';
        $pegawai->email = $faker->companyEmail;
        $pegawai->password = bcrypt('user');
        $pegawai->alamat = $faker->address;
        $pegawai->telepon = $faker->phoneNumber;
        $pegawai->jabatan_id = '3';
        $pegawai->save();
//        $pegawai->jabatan()->attach($jabatan_pegawai);

        $pegawai = new User();
        $pegawai->id = '13';
        $pegawai->name = 'Mike';
        $pegawai->email = $faker->companyEmail;
        $pegawai->password = bcrypt('user');
        $pegawai->alamat = $faker->address;
        $pegawai->telepon = $faker->phoneNumber;
        $pegawai->jabatan_id = '3';
        $pegawai->save();
//        $pegawai->jabatan()->attach($jabatan_pegawai);

        $pegawai = new User();
        $pegawai->id = '14';
        $pegawai->name = 'November';
        $pegawai->email = $faker->companyEmail;
        $pegawai->password = bcrypt('user');
        $pegawai->alamat = $faker->address;
        $pegawai->telepon = $faker->phoneNumber;
        $pegawai->jabatan_id = '3';
        $pegawai->save();
//        $pegawai->jabatan()->attach($jabatan_pegawai);

        $pegawai = new User();
        $pegawai->id = '15';
        $pegawai->name = 'Oscar';
        $pegawai->email = $faker->companyEmail;
        $pegawai->password = bcrypt('user');
        $pegawai->alamat = $faker->address;
        $pegawai->telepon = $faker->phoneNumber;
        $pegawai->jabatan_id = '3';
        $pegawai->save();
//        $pegawai->jabatan()->attach($jabatan_pegawai);

//        DB::table('users')->insert([
//            'id' => '1',
//            'name' => 'user1',
//            'email' => 'user1@user.com',
//            'password' => bcrypt('user'),
//            'alamat' => 'alamat1',
//            'telepon' => '11111',
//            'jabatan' => '1'
//        ]);
//        DB::table('users')->insert([
//            'id' => '2',
//            'name' => 'user2',
//            'email' => 'user2@user.com',
//            'password' => bcrypt('user'),
//            'alamat' => 'alamat2',
//            'telepon' => '22222',
//            'jabatan' => '2'
//        ]);
//        DB::table('users')->insert([
//            'id' => '3',
//            'name' => 'user3',
//            'email' => 'user3@user.com',
//            'password' => bcrypt('user'),
//            'alamat' => 'alamat3',
//            'telepon' => '33333',
//            'jabatan' => '3'
//        ]);
//        DB::table('users')->insert([
//            'id' => '4',
//            'name' => 'user4',
//            'email' => 'user4@user.com',
//            'password' => bcrypt('user'),
//            'alamat' => 'alamat4',
//            'telepon' => '44444',
//            'jabatan' => '3'
//        ]);
//        DB::table('users')->insert([
//            'id' => '5',
//            'name' => 'user5',
//            'email' => 'user5@user.com',
//            'password' => bcrypt('user'),
//            'alamat' => 'alamat5',
//            'telepon' => '55555',
//            'jabatan' => '3'
//        ]);
//        DB::table('users')->insert([
//            'id' => '6',
//            'name' => 'user6',
//            'email' => 'user6@user.com',
//            'password' => bcrypt('user'),
//            'alamat' => 'alamat6',
//            'telepon' => '66666',
//            'jabatan' => '3'
//        ]);
//        DB::table('users')->insert([
//            'id' => '7',
//            'name' => 'user7',
//            'email' => 'user7@user.com',
//            'password' => bcrypt('user'),
//            'alamat' => 'alamat1',
//            'telepon' => '77777',
//            'jabatan' => '3'
//        ]);
//        DB::table('users')->insert([
//            'id' => '8',
//            'name' => 'user8',
//            'email' => 'user8@user.com',
//            'password' => bcrypt('user'),
//            'alamat' => 'alamat8',
//            'telepon' => '88888',
//            'jabatan' => '3'
//        ]);
//        DB::table('users')->insert([
//            'id' => '9',
//            'name' => 'user9',
//            'email' => 'user9@user.com',
//            'password' => bcrypt('user'),
//            'alamat' => 'alamat9',
//            'telepon' => '99999',
//            'jabatan' => '3'
//        ]);
    }
}
