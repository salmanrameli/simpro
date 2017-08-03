<?php

use Illuminate\Database\Seeder;
use App\Jabatan;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan = new Jabatan();
        $jabatan->nama_jabatan = 'administrator';
        $jabatan->save();

        $jabatan = new Jabatan();
        $jabatan->nama_jabatan = 'kepala divisi';
        $jabatan->save();

        $jabatan = new Jabatan();
        $jabatan->nama_jabatan = 'pegawai';
        $jabatan->save();

//        DB::table('jabatan')->insert([
//            'id' => '1',
//            'nama_jabatan' => 'administrator',
//        ]);
//        DB::table('jabatan')->insert([
//            'id' => '2',
//            'nama_jabatan' => 'kepala bagian',
//        ]);
//        DB::table('jabatan')->insert([
//            'id' => '3',
//            'nama_jabatan' => 'pegawai',
//        ]);
    }
}
