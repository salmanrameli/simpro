<?php

use Carbon\Carbon;
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

        foreach (range(1, 15) as $index)
        {
            $now = Carbon::now();

            $parse = Carbon::parse($now);

            $tanggal = $parse->day;
            if($tanggal < 10)
            {
                $tanggal = '0' . $tanggal;
            }

            $bulan = $parse->month;
            if($bulan < 10)
            {
                $bulan = '0' . $bulan;
            }

            $tahun = $parse->year;
            $tahun = substr($tahun, -2);

            $catchphrase = $faker->catchPhrase();

            $nama = strtoupper(substr($catchphrase, 0, 5));

            $kode_kegiatan = $tahun . $bulan . $tanggal . '-' . $index . '-' . $nama;

            $proyek = new \App\Kegiatan();
            $proyek->kode_kegiatan = $kode_kegiatan;
            $proyek->nama_kegiatan = $catchphrase;
            $proyek->id_pemilik_kegiatan = '1';
            $proyek->deskripsi_kegiatan = $faker->paragraph(5);
            $proyek->tanggal_mulai = \Carbon\Carbon::now()->toDateString();
            $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth(2)->toDateString();
            $proyek->tanggal_realisasi = '0000-00-00';
            $proyek->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode_kegiatan;
            $proyek_anggota->nama_kegiatan = $catchphrase;
            $proyek_anggota->id_pegawai = '1';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode_kegiatan;
            $proyek_anggota->nama_kegiatan = $catchphrase;
            $proyek_anggota->id_pegawai = '2';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode_kegiatan;
            $proyek_anggota->nama_kegiatan = $catchphrase;
            $proyek_anggota->id_pegawai = '3';
            $proyek_anggota->save();
        }

        foreach (range(1, 15) as $index)
        {
            $now = Carbon::now();

            $parse = Carbon::parse($now);

            $tanggal = $parse->day;
            if($tanggal < 10)
            {
                $tanggal = '0' . $tanggal;
            }

            $bulan = $parse->month;
            $bulan = $bulan -3;
            if($bulan < 10)
            {
                $bulan = '0' . $bulan;
            }

            $tahun = $parse->year;
            $tahun = substr($tahun, -2);

            $catchphrase = $faker->catchPhrase();

            $nama = strtoupper(substr($catchphrase, 0, 5));

            $kode_kegiatan = $tahun . $bulan . $tanggal . '-' . $index . '-' . $nama;

            $proyek = new \App\Kegiatan();
            $proyek->kode_kegiatan = $kode_kegiatan;
            $proyek->nama_kegiatan = $catchphrase;
            $proyek->id_pemilik_kegiatan = '3';
            $proyek->deskripsi_kegiatan = $faker->paragraph(5);
            $proyek->tanggal_mulai = \Carbon\Carbon::now()->addMonth(-2)->toDateString();
            $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth(7)->toDateString();
            $proyek->tanggal_realisasi = Carbon::now();
            $proyek->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode_kegiatan;
            $proyek_anggota->nama_kegiatan = $catchphrase;
            $proyek_anggota->id_pegawai = '1';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode_kegiatan;
            $proyek_anggota->nama_kegiatan = $catchphrase;
            $proyek_anggota->id_pegawai = '2';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode_kegiatan;
            $proyek_anggota->nama_kegiatan = $catchphrase;
            $proyek_anggota->id_pegawai = '3';
            $proyek_anggota->save();
        }

        foreach (range(1, 15) as $index)
        {
            $now = Carbon::now();

            $parse = Carbon::parse($now);

            $tanggal = $parse->day;
            if($tanggal < 10)
            {
                $tanggal = '0' . $tanggal;
            }

            $bulan = $parse->month;
            $bulan = $bulan -3;
            if($bulan < 10)
            {
                $bulan = '0' . $bulan;
            }

            $tahun = $parse->year;
            $tahun = substr($tahun, -2);

            $catchphrase = $faker->catchPhrase();

            $nama = strtoupper(substr($catchphrase, 0, 5));

            $kode_kegiatan = $tahun . $bulan . $tanggal . '-' . $index . '-' . $nama;

            $proyek = new \App\Kegiatan();
            $proyek->kode_kegiatan = $kode_kegiatan;
            $proyek->nama_kegiatan = $catchphrase;
            $proyek->id_pemilik_kegiatan = '2';
            $proyek->deskripsi_kegiatan = $faker->paragraph(5);
            $proyek->tanggal_mulai = \Carbon\Carbon::now()->addMonth(-2)->toDateString();
            $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth(7)->toDateString();
            $proyek->tanggal_realisasi = '0000-00-00';
            $proyek->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode_kegiatan;
            $proyek_anggota->nama_kegiatan = $catchphrase;
            $proyek_anggota->id_pegawai = '1';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode_kegiatan;
            $proyek_anggota->nama_kegiatan = $catchphrase;
            $proyek_anggota->id_pegawai = '2';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode_kegiatan;
            $proyek_anggota->nama_kegiatan = $catchphrase;
            $proyek_anggota->id_pegawai = '3';
            $proyek_anggota->save();
        }

        foreach (range(1, 15) as $index)
        {
            $now = Carbon::now()->addMonth(-3);

            $parse = Carbon::parse($now);

            $tanggal = $parse->day;
            if($tanggal < 10)
            {
                $tanggal = '0' . $tanggal;
            }

            $bulan = $parse->month;
            if($bulan < 10)
            {
                $bulan = $bulan - 3;
                $bulan = '0' . $bulan;
            }

            $tahun = $parse->year;
            $tahun = substr($tahun, -2);

            $catchphrase = $faker->catchPhrase();

            $nama = strtoupper(substr($catchphrase, 0, 5));

            $kode_kegiatan = $tahun . $bulan . $tanggal . '-' . $index . '-' . $nama;

            $proyek = new \App\Kegiatan();
            $proyek->kode_kegiatan = $kode_kegiatan;
            $proyek->nama_kegiatan = $catchphrase;
            $proyek->id_pemilik_kegiatan = '3';
            $proyek->deskripsi_kegiatan = $faker->paragraph(5);
            $proyek->tanggal_mulai = \Carbon\Carbon::now()->addMonth(-5)->toDateString();
            $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth(-1)->toDateString();
            $proyek->tanggal_realisasi = '0000-00-00';
            $proyek->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode_kegiatan;
            $proyek_anggota->nama_kegiatan = $catchphrase;
            $proyek_anggota->id_pegawai = '1';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode_kegiatan;
            $proyek_anggota->nama_kegiatan = $catchphrase;
            $proyek_anggota->id_pegawai = '2';
            $proyek_anggota->save();

            $proyek_anggota = new \App\Kegiatan_Anggota();
            $proyek_anggota->kode_kegiatan = $kode_kegiatan;
            $proyek_anggota->nama_kegiatan = $catchphrase;
            $proyek_anggota->id_pegawai = '3';
            $proyek_anggota->save();
        }

    }
}
