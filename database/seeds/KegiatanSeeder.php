<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class KegiatanSeeder extends Seeder
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
            $proyek = new \App\Kegiatan();
            $kode = $faker->randomNumber();
            $bulan = $faker->numberBetween(1, 12);
            $proyek->kode_kegiatan = $kode;
            $proyek->nama_kegiatan = $faker->catchPhrase();
            $proyek->id_pemilik_kegiatan = '1';
            $proyek->deskripsi_kegiatan = $faker->paragraph(5);
            $proyek->tanggal_mulai = \Carbon\Carbon::now()->toDateString();
            $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth($bulan)->toDateString();
            $proyek->tanggal_realisasi = '0000-00-00';
            $proyek->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '1';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '2';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '3';
            $proyek_anggota->save();
        }

        foreach (range(1, 10) as $index)
        {
            $proyek = new \App\Kegiatan();
            $kode = $faker->creditCardNumber();
            $bulan = $faker->numberBetween(1, 12);
            $proyek->kode_kegiatan = $kode;
            $proyek->nama_kegiatan = $faker->catchPhrase();
            $proyek->id_pemilik_kegiatan = '1';
            $proyek->deskripsi_kegiatan = $faker->paragraph(5);
            $proyek->tanggal_mulai = \Carbon\Carbon::now()->addMonth(-5)->toDateString();
            $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth($bulan)->toDateString();
            $proyek->tanggal_realisasi = \Carbon\Carbon::now()->toDateString();
            $proyek->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '1';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '2';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '3';
            $proyek_anggota->save();
        }

        foreach (range(1, 10) as $index)
        {
            $proyek = new \App\Kegiatan();
            $kode = $faker->creditCardNumber();
            $proyek->kode_kegiatan = $kode;
            $proyek->nama_kegiatan = $faker->catchPhrase();
            $proyek->id_pemilik_kegiatan = '1';
            $proyek->deskripsi_kegiatan = $faker->paragraph(5);
            $proyek->tanggal_mulai = \Carbon\Carbon::now()->addMonth(-5)->toDateString();
            $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth(-3)->toDateString();
            $proyek->tanggal_realisasi = '0000-00-00';
            $proyek->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '1';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '3';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '5';
            $proyek_anggota->save();
        }

        foreach (range(1, 10) as $index)
        {
            $proyek = new \App\Kegiatan();
            $kode = $faker->creditCardNumber();
            $bulan = $faker->numberBetween(1, 12);
            $proyek->kode_kegiatan = $kode;
            $proyek->nama_kegiatan = $faker->catchPhrase();
            $proyek->id_pemilik_kegiatan = '2';
            $proyek->deskripsi_kegiatan = $faker->paragraph(5);
            $proyek->tanggal_mulai = \Carbon\Carbon::now()->toDateString();
            $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth($bulan)->toDateString();
            $proyek->tanggal_realisasi = '0000-00-00';
            $proyek->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '1';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '2';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '4';
            $proyek_anggota->save();
        }

        foreach (range(1, 10) as $index)
        {
            $proyek = new \App\Kegiatan();
            $kode = $faker->creditCardNumber();
            $bulan = $faker->numberBetween(1, 12);
            $proyek->kode_kegiatan = $kode;
            $proyek->nama_kegiatan = $faker->catchPhrase();
            $proyek->id_pemilik_kegiatan = '5';
            $proyek->deskripsi_kegiatan = $faker->paragraph(5);
            $proyek->tanggal_mulai = \Carbon\Carbon::now()->addMonth(-5)->toDateString();
            $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth(-3)->toDateString();
            $proyek->tanggal_realisasi = '0000-00-00';
            $proyek->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '1';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '3';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '5';
            $proyek_anggota->save();
        }


        foreach (range(1, 10) as $index)
        {
            $proyek = new \App\Kegiatan();
            $kode = $faker->randomNumber();
            $bulan = $faker->numberBetween(1, 12);
            $proyek->kode_kegiatan = $kode;
            $proyek->nama_kegiatan = $faker->catchPhrase();
            $proyek->id_pemilik_kegiatan = '3';
            $proyek->deskripsi_kegiatan = $faker->paragraph(5);
            $proyek->tanggal_mulai = \Carbon\Carbon::now()->toDateString();
            $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth($bulan)->toDateString();
            $proyek->tanggal_realisasi = '0000-00-00';
            $proyek->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '1';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '3';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '4';
            $proyek_anggota->save();
        }

        foreach (range(1, 10) as $index)
        {
            $proyek = new \App\Kegiatan();
            $kode = $faker->randomNumber();
            $bulan = $faker->numberBetween(1, 12);
            $proyek->kode_kegiatan = $kode;
            $proyek->nama_kegiatan = $faker->catchPhrase();
            $proyek->id_pemilik_kegiatan = '4';
            $proyek->deskripsi_kegiatan = $faker->paragraph(5);
            $proyek->tanggal_mulai = \Carbon\Carbon::now()->toDateString();
            $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth($bulan)->toDateString();
            $proyek->tanggal_realisasi = '0000-00-00';
            $proyek->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '1';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '3';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode;
            $proyek_anggota->nama_kegiatan = $proyek->nama_kegiatan;
            $proyek_anggota->id_pegawai = '4';
            $proyek_anggota->save();
        }

    }
}
