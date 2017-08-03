<?php

use Illuminate\Database\Seeder;

class ProyekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $proyek = new \App\Proyek();

        $proyek->kode_proyek = 'P1';
        $proyek->nama_proyek = 'Proyek #1';
        $proyek->pemilik_proyek = '1';
        $proyek->deskripsi_proyek = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur non dapibus nunc, id bibendum dolor. Duis nunc erat, volutpat a dictum at, scelerisque a nisi. Curabitur laoreet ipsum nec urna accumsan, et condimentum magna dignissim. Integer nec nisl velit.';
        $proyek->tanggal_mulai = \Carbon\Carbon::now()->toDateString();
        $proyek->tanggal_target_selesai = \Carbon\Carbon::now()->addMonth(1)->toDateString();
        $proyek->tanggal_realisasi = '0000-00-00';
        $proyek->save();

        $proyek_anggota = new \App\Proyek_Anggota();

        $proyek_anggota->kode_proyek = 'P1';
        $proyek_anggota->nama_proyek = 'Proyek #1';
        $proyek_anggota->id_pegawai = '1';
        $proyek_anggota->save();

        $proyek_anggota = new \App\Proyek_Anggota();

        $proyek_anggota->kode_proyek = 'P1';
        $proyek_anggota->nama_proyek = 'Proyek #1';
        $proyek_anggota->id_pegawai = '2';
        $proyek_anggota->save();

        $proyek_anggota = new \App\Proyek_Anggota();

        $proyek_anggota->kode_proyek = 'P1';
        $proyek_anggota->nama_proyek = 'Proyek #1';
        $proyek_anggota->id_pegawai = '3';
        $proyek_anggota->save();

        $proyek_progress = new \App\Proyek_Progress();

        $proyek_progress->kode_proyek = 'P1';
        $proyek_progress->id_pegawai = '1';
        $proyek_progress->kegiatan = 'inisialisasi proyek';
        $proyek_progress->progress = '100';
        $proyek_progress->keterangan = 'Ut vitae nunc porta, vulputate nibh a, sagittis lorem. Vestibulum ac iaculis risus. Donec nunc urna, fermentum eu metus vel, consectetur convallis lectus. Nullam vitae nisl sed sem lobortis faucibus nec eu dui.';
        $proyek_progress->save();
    }
}
