<?php

namespace App\Http\Controllers;

use App\Log;
use App\Kegiatan;
use App\Kegiatan_Anggota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KegiatanController extends Controller
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
        $paginate = 10;
        /*
         * Menampilkan semua proyek jika user termasuk salah satu anggotanya.
         * Diurutkan berdasarkan kolom created_at secara ascending.
         */
        $kegiatan = DB::table('kegiatan')
            ->join('users', 'kegiatan.id_pemilik_kegiatan', '=', 'users.id')
            ->select('kegiatan.*', 'users.name')
            ->orderBy('kegiatan.created_at', 'desc')
            ->paginate($paginate);

        return view('kegiatan.index')
            ->with('proyeks', $kegiatan);
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

        return view('kegiatan.create')->with('users', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $names = count($request->get('nama'));

        $now = Carbon::now();

        $terakhir = DB::table('kegiatan')->latest('tanggal_mulai')->value('tanggal_mulai');
        $counter = DB::table('kegiatan')->latest('tanggal_mulai')->value('kode_kegiatan');
        $terakhir = explode('-', $terakhir);
        $counter = explode('-', $counter);
        $antrian = intval($counter[3]);

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

        $nama = $request->nama_proyek;
        $nama = strtoupper(substr($nama, 0, 5));

        if($tanggal != $terakhir[2])
        {
            $antrian = 1;
        }
        else
        {
            $antrian += 1;
        }

        $kode_kegiatan = $tahun . $bulan . $tanggal . '-' . $antrian . '-' . $nama;

//        Session::flash('message', $kode_kegiatan);
//
//        return redirect()->back();


        $this->validate($request, [
            'nama_proyek' => 'required',
            'deskripsi_proyek' => 'required',
        ]);

        $kode = $request->kode_proyek;

        $kode_proyek = DB::table('kegiatan')->where('kode_kegiatan', $kode)->first();

        /*
         * Kegiatan akan disimpan hanya jika kode proyek belum terdaftar pada tabel proyek.
         * Jika sudah terdaftar, pengguna akan diminta untuk mendaftarkan menggunakan kode yang berbeda.
         */
        if($kode_proyek == null)
        {
            /*
         * Mendaftarkan kode, nama, dan pemilik proyek ke tabel proyek.
         * Pemilik proyek adalah akun yang mendaftarkan proyek.
         * Dilakukan untuk menghindari terjadinya duplikasi kode proyek.
         */
            $proyek = new Kegiatan();

            $proyek->kode_kegiatan = $kode_kegiatan;
            $proyek->nama_kegiatan = $request->nama_proyek;
            $proyek->id_pemilik_kegiatan= Auth::id();
            $proyek->deskripsi_kegiatan = $request->deskripsi_proyek;
            $proyek->tanggal_mulai = $request->tanggal_mulai;
            $proyek->tanggal_target_selesai = $request->tanggal_target_selesai;
            $proyek->tanggal_realisasi = '0';
            $proyek->save();

            /*
             * Mencatat kegiatan yang dilakukan ke tabel Log.
             */
            $log = new Log();

            $log->id_pegawai = $request->user()->id;
            $log->data = "membuat kegiatan " . $kode_kegiatan;
            $log->save();

            /*
             * Mendaftarkan akun pembuat proyek ke tabel anggota_proyek.
             */
            $anggota_proyek = new Kegiatan_Anggota();

            $anggota_proyek->kode_kegiatan = $kode_kegiatan;
            $anggota_proyek->nama_kegiatan = $request->nama_proyek;
            $anggota_proyek->id_pegawai = $request->user()->id;
            $anggota_proyek->save();

            /*
             * Mendaftarkan kode, nama, dan anggota proyek ke tabel proyek_anggota.
             * Looping dilakukan untuk memasukkan data setiap anggota proyek yang dipilih ke tabel proyek_anggota.
             */
            for($i=0; $i<$names; $i++)
            {
                $anggota_proyek = new Kegiatan_Anggota();

                $anggota_proyek->kode_kegiatan = $kode_kegiatan;
                $anggota_proyek->nama_kegiatan = $request->nama_proyek;
                $anggota_proyek->id_pegawai = $request->nama[$i];
                $anggota_proyek->save();

                /*
                 * Mencatat kegiatan yang dilakukan ke tabel log.
                 */
                $log = new Log();

                $log->id_pegawai = Auth::id();
                $log->data = "menambah pegawai " . $request->nama[$i] . " ke kegiatan " . $kode_kegiatan;
                $log->save();
            }

            Session::flash('message', 'Kegiatan berhasil didaftarkan');

        return redirect()->route('kegiatan.show', $kode_kegiatan);
        }
        else
        {
            Session::flash('warning', 'Kode kegiatan sudah terdaftar. Daftarkan kegiatan menggunakan kode yang berbeda');

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

        $pemilik_proyek = DB::table('kegiatan')->where('kode_kegiatan', $id)->value('id_pemilik_kegiatan');

        $tugas_baru = DB::table('kegiatan_subtask')->where([['kode_kegiatan', $id], ['status', '0']])->latest('updated_at')->get();

        $deskripsi_proyek = DB::table('kegiatan')->join('users', 'kegiatan.id_pemilik_kegiatan', '=', 'users.id')->where('kegiatan.kode_kegiatan', $id)->first();

        $anggota_proyek = DB::table('kegiatan_anggota')->join('users', 'kegiatan_anggota.id_pegawai', '=', 'users.id')->select('users.id', 'users.name', 'users.email', 'users.telepon')->where('kegiatan_anggota.kode_kegiatan', $id)->simplePaginate($paginate);

        $dokumen = DB::table('dokumen')
            ->join('users', 'dokumen.id_pegawai', '=', 'users.id')
            ->join('kegiatan_subtask', 'dokumen.id_subtask', '=', 'kegiatan_subtask.id')
            ->select('dokumen.*', 'users.name', 'kegiatan_subtask.nama_subtask')->where('dokumen.kode_kegiatan', $id)
            ->get();

        $user = DB::table('kegiatan_anggota')->join('users', 'kegiatan_anggota.id_pegawai', '=', 'users.id')->select('kegiatan_anggota.*', 'users.name')->where('kegiatan_anggota.kode_kegiatan', $id)->get();

        $kegiatan = DB::table('kegiatan_subtask')->where('kode_kegiatan', $id)->groupBy('nama_subtask')->get();

        if($pemilik_proyek == $uid)
        {
            $tugas_ongoing = DB::table('kegiatan_subtask')->where([['kode_kegiatan', $id], ['status', '1']])->latest('updated_at')->get();

            $tugas_request = DB::table('kegiatan_subtask')->where([['kode_kegiatan', $id], ['status', '2']])->latest('updated_at')->get();

            $tugas_selesai = DB::table('kegiatan_subtask')->where([['kode_kegiatan', $id], ['status', '3']])->latest('updated_at')->get();

            return view('kegiatan.show-owner')
                ->with('deskripsi', $deskripsi_proyek)
                ->with('barus', $tugas_baru)
                ->with('ongoings', $tugas_ongoing)
                ->with('requests', $tugas_request)
                ->with('selesais', $tugas_selesai)
                ->with('kode', $id)
                ->with('anggotas', $anggota_proyek)
                ->with('dokumens', $dokumen)
                ->with('users', $user)
                ->with('subtasks', $kegiatan);
        }
        else
        {
            $tugas_ongoing = DB::table('kegiatan_subtask')->where([['kode_kegiatan', $id], ['status', '1']])->latest('updated_at')->get();

            $tugas_request = DB::table('kegiatan_subtask')->where([['kode_kegiatan', $id], ['status', '2']])->latest('updated_at')->get();

            $tugas_selesai = DB::table('kegiatan_subtask')->where([['kode_kegiatan', $id], ['status', '3']])->latest('updated_at')->get();

            return view('kegiatan.show')
                ->with('deskripsi', $deskripsi_proyek)
                ->with('barus', $tugas_baru)
                ->with('ongoings', $tugas_ongoing)
                ->with('requests', $tugas_request)
                ->with('selesais', $tugas_selesai)
                ->with('kode', $id)
                ->with('anggotas', $anggota_proyek)
                ->with('dokumens', $dokumen)
                ->with('users', $user)
                ->with('subtasks', $kegiatan);
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
        $proyek = DB::table('kegiatan')->where('kode_proyek', $id)->first();

        return view('kegiatan.edit')->with('kegiatan', $proyek);
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

        DB::table('kegiatan')->where('kode_proyek', $kode_lama)->update(
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

        return redirect()->route('kegiatan.show', $request->kode_proyek);
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
         * Menampilkan daftar pegawai yang menjadi anggota kegiatan dari kegiatan yang dipilih.
         */
        $uid = Auth::id();

        $anggota = DB::table('kegiatan_anggota')->join('users', 'kegiatan_anggota.id_pegawai', '=', 'users.id')->select('kegiatan_anggota.*', 'users.name')->where('kode_kegiatan', $id)->where('kegiatan_anggota.id_pegawai', '<>', $uid)->get();

        return view('kegiatan.hapus_anggota')->with('users', $anggota)->with('kode', $id);
    }

    public function hapus_anggota_proyek($id, $kode)
    {
        /*
         * Menghapus anggota yang dipilih dari proyek.
         */
        DB::table('kegiatan_anggota')->where([['kode_kegiatan', '=', $id], ['id_pegawai', $kode]])->delete();

        /*
         * Mencatat kegiatan yang dilakukan ke tabel log.
         */
        $log = new Log();

        $log->id_pegawai = Auth::id();
        $log->data = "menghapus pegawai " . $kode . " dari kegiatan " . $id;
        $log->save();

        $message = "Anggota berhasil dihapus";

        return redirect()->route('kegiatan.show', $id)->with('message', $message);
    }

    public function tambah_anggota($id)
    {
        /*
         * Menampilkan daftar pegawai yang bukan anggota dari proyek.
         */
        $anggota_sekarang = Kegiatan_Anggota::where('kode_kegiatan', '=', $id)->pluck('id_pegawai')->toArray();

        $nama_proyek = DB::table('kegiatan_anggota')->where('kode_kegiatan', $id)->value('nama_kegiatan');

        $users = DB::table('users')->whereNotIn('id', $anggota_sekarang)->get();

        return view('kegiatan.tambah_anggota')->with('users', $users)->with('kode', $id)->with('nama_kegiatan', $nama_proyek);
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
            $anggota_proyek = new Kegiatan_Anggota();

            $anggota_proyek->kode_kegiatan = $id;
            $anggota_proyek->nama_kegiatan = $request->nama_proyek;
            $anggota_proyek->id_pegawai = $name;
            $anggota_proyek->save();

            /*
             * Mencatat kegiatan yang dilakukan ke tabel log.
             */
            $log = new Log();

            $log->id_pegawai = Auth::id();
            $log->data = "menambah pegawai " . $name . " ke kegiatan " . $id;
            $log->save();
        }

        $message = "Anggota berhasil ditambah";

        return redirect()->route('kegiatan.show', $id)->with('message', $message);
    }

    public function tandai_selesai($id)
    {
        $sekarang = Carbon::now()->toDateString();

        DB::table('kegiatan')->where('kode_kegiatan', $id)->update(['tanggal_realisasi' => $sekarang]);

        return redirect()->back()->with('message', 'Kegiatan berhasil ditandai selesai');
    }

    public function belum_selesai($id)
    {
        DB::table('kegiatan')->where('kode_kegiatan', $id)->update(['tanggal_realisasi' => '0000-00-00']);

        return redirect()->back()->with('message', 'Kegiatan berhasil ditandai belum selesai');
    }

    public function cari(Request $request)
    {
        $kategori = $request->get('kategori');
        $query = $request->get('query');

        switch ($kategori)
        {
            case '0':
                $hasil = DB::table('kegiatan')->join('users', 'kegiatan.id_pemilik_kegiatan', '=', 'users.id')->select('kegiatan.*', 'users.name')
                    ->where('kegiatan.kode_kegiatan', 'like', '%'.$query.'%')
                    ->orWhere('kegiatan.nama_kegiatan', 'like', '%'.$query.'%')
                    ->orWhere('kegiatan.tanggal_mulai', 'like', '%'.$query.'%')
                    ->orWhere('kegiatan.tanggal_target_selesai', 'like', '%'.$query.'%')
                    ->orWhere('users.name', 'like', '%'.$query.'%')
                    ->get();

                return view('kegiatan.hasil-cari')->with('results', $hasil)->with('query', $query);
                break;

            case '1':
                $hasil = DB::table('kegiatan')->join('users', 'kegiatan.id_pemilik_kegiatan', '=', 'users.id')->select('kegiatan.*', 'users.name')
                    ->where('kegiatan.kode_kegiatan', 'like', '%'.$query.'%')->get();

                return view('kegiatan.hasil-cari')->with('results', $hasil)->with('query', $query);
                break;

            case '2':
                $hasil = DB::table('kegiatan')->join('users', 'kegiatan.id_pemilik_kegiatan', '=', 'users.id')->select('kegiatan.*', 'users.name')
                    ->where('kegiatan.nama_kegiatan', 'like', '%'.$query.'%')->get();

                return view('kegiatan.hasil-cari')->with('results', $hasil)->with('query', $query);
                break;

            case '3':
                $hasil = DB::table('kegiatan')->join('users', 'kegiatan.id_pemilik_kegiatan', '=', 'users.id')->select('kegiatan.*', 'users.name')
                    ->where('users.name', 'like', '%'.$query.'%')->get();

                return view('kegiatan.hasil-cari')->with('results', $hasil)->with('query', $query);
                break;

            case '4':
                $hasil = DB::table('kegiatan')->join('users', 'kegiatan.id_pemilik_kegiatan', '=', 'users.id')->select('kegiatan.*', 'users.name')
                    ->where('kegiatan.tanggal_mulai', 'like', '%'.$query.'%')->get();

                return view('kegiatan.hasil-cari')->with('results', $hasil)->with('query', $query);
                break;

            case '5':
                $hasil = DB::table('kegiatan')->join('users', 'kegiatan.id_pemilik_kegiatan', '=', 'users.id')->select('kegiatan.*', 'users.name')
                    ->where('kegiatan.tanggal_ target_selesai', 'like', '%'.$query.'%')->get();

                return view('kegiatan.hasil-cari')->with('results', $hasil)->with('query', $query);
                break;
        }
    }

    public function cari_tanggal(Request $request)
    {
        $mulai = $request->get('tgl_mulai');
        $selesai = $request->get('tgl_selesai');
        $kategori = $request->get('kategori');

        switch ($kategori)
        {
            case '0':
                $this->validate($request, [
                    'tgl_mulai' => 'required',
                    'tgl_selesai' => 'required'
                ]);

                $query = 'tanggal ' . $mulai . ' s.d. ' . $selesai;

                $hasil = DB::table('kegiatan')->join('users', 'kegiatan.id_pemilik_kegiatan', '=', 'users.id')->select('kegiatan.*', 'users.name')
                    ->where([['kegiatan.tanggal_mulai', '>=', $mulai], ['kegiatan.tanggal_target_selesai', '<=', $selesai]])->get();

                return view('kegiatan.hasil-cari')->with('results', $hasil)->with('query', $query);
                break;

            case '1':
                $this->validate($request, [
                    'tgl_mulai' => 'required'
                ]);

                $query = $mulai ;

                $hasil = DB::table('kegiatan')->join('users', 'kegiatan.id_pemilik_kegiatan', '=', 'users.id')->select('kegiatan.*', 'users.name')
                    ->where('kegiatan.tanggal_mulai', $mulai)->get();

                return view('kegiatan.hasil-cari')->with('results', $hasil)->with('query', $query);
                break;

            case '2':
                $this->validate($request, [
                    'tgl_mulai' => 'required',
                    'tgl_selesai' => 'required'
                ]);

                $query = 'tanggal ' . $mulai . ' s.d. ' . $selesai;

                $hasil = DB::table('kegiatan')->join('users', 'kegiatan.id_pemilik_kegiatan', '=', 'users.id')->select('kegiatan.*', 'users.name')
                    ->whereBetween('kegiatan.tanggal_mulai', [$mulai, $selesai])->get();

                return view('kegiatan.hasil-cari')->with('results', $hasil)->with('query', $query);
                break;

            case '3':
                $this->validate($request, [
                    'tgl_mulai' => 'required'
                ]);

                $query = 'tanggal ' . $mulai;

                $hasil = DB::table('kegiatan')->join('users', 'kegiatan.id_pemilik_kegiatan', '=', 'users.id')->select('kegiatan.*', 'users.name')
                    ->where('kegiatan.tanggal_target_selesai', $mulai)->get();

                return view('kegiatan.hasil-cari')->with('results', $hasil)->with('query', $query);
                break;

            case '4':
                $this->validate($request, [
                    'tgl_mulai' => 'required',
                    'tgl_selesai' => 'required'
                ]);

                $query = 'tanggal ' . $mulai . ' s.d.' . $selesai;

                $hasil = DB::table('kegiatan')->join('users', 'kegiatan.id_pemilik_kegiatan', '=', 'users.id')->select('kegiatan.*', 'users.name')
                    ->whereBetween('kegiatan.tanggal_target_selesai', [$mulai, $selesai])->get();

                return view('kegiatan.hasil-cari')->with('results', $hasil)->with('query', $query);
                break;
        }
    }
}
