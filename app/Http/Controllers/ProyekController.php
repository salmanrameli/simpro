<?php

namespace App\Http\Controllers;

use App\Log;
use App\Proyek;
use App\Proyek_Anggota;
use App\Proyek_Progress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProyekController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
         * Menampilkan semua proyek jika user termasuk salah satu anggotanya.
         * Diurutkan berdasarkan kolom created_at secara ascending.
         */
        $paginate = 100;

        $proyek = DB::table('proyek_anggota')
            ->join('proyek', 'proyek_anggota.kode_proyek', '=', 'proyek.kode_proyek')
            ->select('proyek_anggota.*',  'proyek.nama_proyek', 'proyek.id_pemilik_proyek', 'proyek.nama_pemilik_proyek', 'proyek.tanggal_mulai', 'proyek.tanggal_target_selesai')
            ->where('proyek_anggota.id_pegawai', Auth::id())
            ->latest()
            ->simplePaginate($paginate);

        return view('proyek.index')
            ->with('proyeks', $proyek);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
         * Hanya menampilkan daftar pegawai selain akun yang sedang login sekarang.
         */
        $user = DB::table('users')->where('id', '<>', Auth::id())->orderBy('name', 'asc')->get();

        return view('proyek.create')->with('users', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $names = $request->get('anggota');

        $this->validate($request, [
            'kode_proyek' => 'required',
            'nama_proyek' => 'required',
            'deskripsi_proyek' => 'required',
            'tanggal_target_selesai' => 'required|date'
        ]);

        $kode = $request->kode_proyek;

        $kode_proyek = DB::table('proyek')->where('kode_proyek', $kode)->first();

        /*
         * Proyek akan disimpan hanya jika kode proyek belum terdaftar pada tabel proyek.
         * Jika sudah terdaftar, pengguna akan diminta untuk mendaftarkan menggunakan kode yang berbeda.
         */
        if($kode_proyek == null)
        {
            /*
         * Mendaftarkan kode, nama, dan pemilik proyek ke tabel proyek.
         * Pemilik proyek adalah akun yang mendaftarkan proyek.
         * Dilakukan untuk menghindari terjadinya duplikasi kode proyek.
         */
            $proyek = new Proyek();

            $proyek->kode_proyek = $request->kode_proyek;
            $proyek->nama_proyek = $request->nama_proyek;
            $proyek->id_pemilik_proyek = Auth::id();
            $proyek->nama_pemilik_proyek = DB::table('users')->where('id', Auth::id())->value('name');
            $proyek->deskripsi_proyek = $request->deskripsi_proyek;
            $proyek->tanggal_mulai = $request->tanggal_mulai;
            $proyek->tanggal_target_selesai = $request->tanggal_target_selesai;
            $proyek->tanggal_realisasi = '0';
            $proyek->save();

            /*
             * Mencatat kegiatan yang dilakukan ke tabel Log.
             */
            $log = new Log();

            $log->id_pegawai = $request->user()->id;
            $log->data = "membuat proyek " . $request->kode_proyek;
            $log->save();

            /*
             * Mendaftarkan akun pembuat proyek ke tabel anggota_proyek.
             */
            $anggota_proyek = new Proyek_Anggota();

            $anggota_proyek->kode_proyek = $request->kode_proyek;
            $anggota_proyek->nama_proyek = $request->nama_proyek;
            $anggota_proyek->id_pegawai = $request->user()->id;
            $anggota_proyek->save();

            /*
             * Mendaftarkan kode, nama, dan anggota proyek ke tabel proyek_anggota.
             * Looping dilakukan untuk memasukkan data setiap anggota proyek yang dipilih ke tabel proyek_anggota.
             */
            foreach ($names as $name)
            {
                $anggota_proyek = new Proyek_Anggota();

                $anggota_proyek->kode_proyek = $request->kode_proyek;
                $anggota_proyek->nama_proyek = $request->nama_proyek;
                $anggota_proyek->id_pegawai = $name;
                $anggota_proyek->save();

                /*
                 * Mencatat kegiatan yang dilakukan ke tabel log.
                 */
                $log = new Log();

                $log->id_pegawai = Auth::id();
                $log->data = "menambah pegawai " . $name . " ke proyek " . $request->kode_proyek;
                $log->save();
            }

            Session::flash('message', 'Proyek berhasil didaftarkan');

            return redirect()->route('proyek.index');
        }
        else
        {
            Session::flash('warning', 'Kode proyek sudah terdaftar. Daftarkan proyek menggunakan kode yang berbeda');

            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*
         * Menampilkan progress proyek.
         * Pemilik proyek dapat melihat semua informasi yang dimasukkan oleh anggota proyek.
         * Anggota proyek hanya dapat melihat informasi yang dimasukkan oleh sendiri.
         */
        $paginate = 10;

        $uid = Auth::id();

        $pemilik_proyek = DB::table('proyek')->where('kode_proyek', $id)->value('id_pemilik_proyek');

        $tugas_baru = DB::table('proyek_tugas')->where([['kode_proyek', $id], ['status', '0']])->latest('updated_at')->get();

        $deskripsi_proyek = DB::table('proyek')->join('users', 'proyek.id_pemilik_proyek', '=', 'users.id')->where('proyek.kode_proyek', $id)->first();

        $anggota_proyek = DB::table('proyek_anggota')->join('users', 'proyek_anggota.id_pegawai', '=', 'users.id')->select('users.id', 'users.name', 'users.email', 'users.telepon')->where('proyek_anggota.kode_proyek', $id)->simplePaginate($paginate);

        $dokumen = DB::table('dokumen')->join('users', 'dokumen.id_pegawai', '=', 'users.id')->select('dokumen.*', 'users.name')->where('kode_proyek', $id)->simplePaginate($paginate);

        if($pemilik_proyek == $uid)
        {
            $tugas_ongoing = DB::table('proyek_tugas')->where([['kode_proyek', $id], ['status', '1']])->latest('updated_at')->get();

            $tugas_request = DB::table('proyek_tugas')->where([['kode_proyek', $id], ['status', '2']])->latest('updated_at')->get();

            $tugas_selesai = DB::table('proyek_tugas')->where([['kode_proyek', $id], ['status', '3']])->latest('updated_at')->get();

            return view('proyek.show-owner')
                ->with('deskripsi', $deskripsi_proyek)
                ->with('barus', $tugas_baru)
                ->with('ongoings', $tugas_ongoing)
                ->with('requests', $tugas_request)
                ->with('selesais', $tugas_selesai)
                ->with('kode', $id)
                ->with('anggotas', $anggota_proyek)
                ->with('dokumens', $dokumen);
        }
        else
        {
            $tugas_ongoing = DB::table('proyek_tugas')->where([['kode_proyek', $id], ['status', '1'], ['id_pegawai_mengerjakan', $uid]])->latest('updated_at')->get();

            $tugas_request = DB::table('proyek_tugas')->where([['kode_proyek', $id], ['status', '2'], ['id_pegawai_mengerjakan', $uid]])->latest('updated_at')->get();

            $tugas_selesai = DB::table('proyek_tugas')->where([['kode_proyek', $id], ['status', '3'], ['id_pegawai_mengerjakan', $uid]])->latest('updated_at')->get();

            return view('proyek.show')
                ->with('deskripsi', $deskripsi_proyek)
                ->with('barus', $tugas_baru)
                ->with('ongoings', $tugas_ongoing)
                ->with('requests', $tugas_request)
                ->with('selesais', $tugas_selesai)
                ->with('kode', $id)
                ->with('anggotas', $anggota_proyek)
                ->with('dokumens', $dokumen);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proyek = DB::table('proyek')->where('kode_proyek', $id)->first();

        return view('proyek.edit')->with('proyek', $proyek);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*
         * Menyimpan perubahan data proyek.
         * Perubahan  dilakukan pada tabel proyek, proyek_anggota, dan proyek_progress.
         * $kode_lama adalah kode proyek sebelum diubah, digunakan untuk query update berdasarkan kolom kode_proyek.
         */
        $this->validate($request, [
            'kode_proyek_lama' => 'required',
            'kode_proyek' => 'required',
            'nama_proyek' => 'required',
            'deskripsi_proyek' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_target_selesai' => 'required|date',
        ]);

        $kode_lama = $request->kode_proyek_lama;

        DB::table('proyek')->where('kode_proyek', $kode_lama)->update(
            ['kode_proyek' => $request->kode_proyek],
            ['nama_proyek' => $request->nama_proyek],
            ['deskripsi_proyek' => $request->deskripsi_proyek],
            ['tanggal_mulai' => $request->tanggal_mulai],
            ['tanggal_target_selesai' => $request->tanggal_target_selesai]
        );

        DB::table('proyek_anggota')->where('kode_proyek', $kode_lama)->update(
            ['kode_proyek' => $request->kode_proyek],
            ['nama_proyek' => $request->nama_proyek]
        );

        DB::table('proyek_progress')->where('kode_proyek', $kode_lama)->update(
            ['kode_proyek' => $request->kode_proyek]
        );

        /*
         * Mencatat kegiatan yang dilakukan ke tabel log.
         */
        $log = new Log();

        $log->id_pegawai = Auth::id();
        $log->data = "ubah proyek kode lama: " . $kode_lama . " kode baru: ". $request->kode_proyek;
        $log->save();

        Session::flash('message', 'Perubahan proyek berhasil disimpan');

        return redirect()->route('proyek.show', $request->kode_proyek);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function anggota_proyek($id)
    {
        /*
         * Menampilkan daftar pegawai yang menjadi anggota proyek dari proyek yang dipilih.
         */
        $uid = Auth::id();

        $anggota = DB::table('proyek_anggota')->join('users', 'proyek_anggota.id_pegawai', '=', 'users.id')->select('proyek_anggota.*', 'users.name')->where('kode_proyek', $id)->where('proyek_anggota.id_pegawai', '<>', $uid)->get();

        return view('proyek.hapus_anggota')->with('users', $anggota)->with('kode', $id);
    }

    public function hapus_anggota_proyek($id, $kode)
    {
        /*
         * Menghapus anggota yang dipilih dari proyek.
         */
        DB::table('proyek_anggota')->where([['kode_proyek', '=', $id], ['id_pegawai', $kode]])->delete();

        /*
         * Mencatat kegiatan yang dilakukan ke tabel log.
         */
        $log = new Log();

        $log->id_pegawai = Auth::id();
        $log->data = "menghapus pegawai " . $kode . " dari proyek " . $id;
        $log->save();

        $message = "Anggota berhasil dihapus";

        return redirect()->route('proyek.show', $id)->with('message', $message);
    }

    public function tambah_anggota($id)
    {
        /*
         * Menampilkan daftar pegawai yang bukan anggota dari proyek.
         */
        $anggota_sekarang = Proyek_Anggota::where('kode_proyek', '=', $id)->pluck('id_pegawai')->toArray();

        $nama_proyek = DB::table('proyek_anggota')->where('kode_proyek', $id)->value('nama_proyek');

        $users = DB::table('users')->whereNotIn('id', $anggota_sekarang)->get();

        return view('proyek.tambah_anggota')->with('users', $users)->with('kode', $id)->with('nama_proyek', $nama_proyek);
    }

    public function tambah_anggota_proyek(Request $request, $id)
    {
        /*
         * Menambah pegawai yang dipilih ke dalam proyek.
         */
        $names = $request->get('anggota');

        $this->validate($request, [
            'nama_proyek' => 'required'
        ]);

        foreach ($names as $name)
        {
            $anggota_proyek = new Proyek_Anggota();

            $anggota_proyek->kode_proyek = $id;
            $anggota_proyek->nama_proyek = $request->nama_proyek;
            $anggota_proyek->id_pegawai = $name;
            $anggota_proyek->save();

            /*
             * Mencatat kegiatan yang dilakukan ke tabel log.
             */
            $log = new Log();

            $log->id_pegawai = Auth::id();
            $log->data = "menambah pegawai " . $name . " ke proyek " . $id;
            $log->save();
        }

        $message = "Anggota berhasil ditambah";

        return redirect()->route('proyek.show', $id)->with('message', $message);
    }

    public function tandai_selesai($id)
    {
        $sekarang = Carbon::now()->toDateString();

        DB::table('proyek')->where('kode_proyek', $id)->update(['tanggal_realisasi' => $sekarang]);

        return redirect()->back()->with('message', 'Proyek berhasil ditandai selesai');
    }

    public function belum_selesai($id)
    {
        DB::table('proyek')->where('kode_proyek', $id)->update(['tanggal_realisasi' => '0000-00-00']);

        return redirect()->route('proyek.index')->with('message', 'Proyek berhasil ditandai belum selesai');
    }
}
