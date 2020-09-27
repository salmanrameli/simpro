<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jabatan')->insert([
            'nama_jabatan' => 'administrator',
        ]);

        DB::table('jabatan')->insert([
            'nama_jabatan' => 'kepala divisi',
        ]);

        DB::table('jabatan')->insert([
            'nama_jabatan' => 'pegawai',
        ]);
    }
}
