<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProyekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index)
        {
            $proyek = new \App\Proyek();
            $kode = $faker->randomNumber();
            $bulan = $faker->numberBetween(1, 12);
            $proyek->kode_proyek = $kode;
            $proyek->nama_proyek = $faker->catchPhrase();
            $proyek->id_pemilik_proyek = '1';
            $proyek->nama_pemilik_proyek = 'Alpha';
            $proyek->deskripsi_proyek = $faker->paragraph(5);
            $proyek->tanggal_mulai = \Carbon\Carbon::now()->toDateString();
            $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth($bulan)->toDateString();
            $proyek->tanggal_realisasi = '0000-00-00';
            $proyek->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '1';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '2';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '3';
            $proyek_anggota->save();
        }

        foreach (range(1, 10) as $index)
        {
            $proyek = new \App\Proyek();
            $kode = $faker->creditCardNumber();
            $proyek->kode_proyek = $kode;
            $proyek->nama_proyek = $faker->catchPhrase();
            $proyek->id_pemilik_proyek = '3';
            $proyek->nama_pemilik_proyek = 'Charlie';
            $proyek->deskripsi_proyek = $faker->paragraph(5);
            $proyek->tanggal_mulai = \Carbon\Carbon::now()->addMonth(-5)->toDateString();
            $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth(-3)->toDateString();
            $proyek->tanggal_realisasi = '0000-00-00';
            $proyek->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '1';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '3';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '5';
            $proyek_anggota->save();
        }

        foreach (range(1, 10) as $index)
        {
            $proyek = new \App\Proyek();
            $kode = $faker->randomNumber();
            $proyek->kode_proyek = $kode;
            $bulan = $faker->numberBetween(1, 12);
            $proyek->nama_proyek = $faker->catchPhrase();
            $proyek->id_pemilik_proyek = '2';
            $proyek->nama_pemilik_proyek = 'Bravo';
            $proyek->deskripsi_proyek = $faker->paragraph(5);
            $proyek->tanggal_mulai = \Carbon\Carbon::now()->toDateString();
            $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth($bulan)->toDateString();
            $proyek->tanggal_realisasi = '0000-00-00';
            $proyek->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '1';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '2';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '4';
            $proyek_anggota->save();
        }

        foreach (range(1, 10) as $index)
        {
            $proyek = new \App\Proyek();
            $kode = $faker->creditCardNumber();
            $proyek->kode_proyek = $kode;
            $proyek->nama_proyek = $faker->catchPhrase();
            $proyek->id_pemilik_proyek = '5';
            $proyek->nama_pemilik_proyek = 'Echo';
            $proyek->deskripsi_proyek = $faker->paragraph(5);
            $proyek->tanggal_mulai = \Carbon\Carbon::now()->addMonth(-5)->toDateString();
            $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth(-3)->toDateString();
            $proyek->tanggal_realisasi = '0000-00-00';
            $proyek->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '1';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '3';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '5';
            $proyek_anggota->save();
        }


        foreach (range(1, 10) as $index)
        {
            $proyek = new \App\Proyek();
            $kode = $faker->randomNumber();
            $proyek->kode_proyek = $kode;
            $bulan = $faker->numberBetween(1, 12);
            $proyek->nama_proyek = $faker->catchPhrase();
            $proyek->id_pemilik_proyek = '3';
            $proyek->nama_pemilik_proyek = 'Charlie';
            $proyek->deskripsi_proyek = $faker->paragraph(5);
            $proyek->tanggal_mulai = \Carbon\Carbon::now()->toDateString();
            $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth($bulan)->toDateString();
            $proyek->tanggal_realisasi = '0000-00-00';
            $proyek->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '1';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '3';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '4';
            $proyek_anggota->save();
        }

        foreach (range(1, 10) as $index)
        {
            $proyek = new \App\Proyek();
            $kode = $faker->randomNumber();
            $proyek->kode_proyek = $kode;
            $bulan = $faker->numberBetween(1, 12);
            $proyek->nama_proyek = $faker->catchPhrase();
            $proyek->id_pemilik_proyek = '4';
            $proyek->nama_pemilik_proyek = 'Delta';
            $proyek->deskripsi_proyek = $faker->paragraph(5);
            $proyek->tanggal_mulai = \Carbon\Carbon::now()->toDateString();
            $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth($bulan)->toDateString();
            $proyek->tanggal_realisasi = '0000-00-00';
            $proyek->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '1';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '3';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Proyek_Anggota();
            $proyek_anggota->kode_proyek = $kode;
            $proyek_anggota->nama_proyek = $proyek->nama_proyek;
            $proyek_anggota->id_pegawai = '4';
            $proyek_anggota->save();
        }

    }
}
