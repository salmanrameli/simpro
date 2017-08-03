<?php

namespace App\Http\Controllers;

use App\Log;
use App\Proyek_Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProyekProgressController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('proyek_progress.create')->with('id', $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
         * Menyimpan progress proyek.
         */
        $uid = Auth::id();

        $this->validate($request, [
            'kode_proyek' => 'required',
            'kegiatan' => 'required',
            'progress' => 'required',
            'keterangan' => 'required'
        ]);

        $progress = new Proyek_Progress();

        $presentase = $request->progress;

        if($presentase > 100)
        {
            $presentase = 100;
        }

        $progress->kode_proyek = $request->kode_proyek;
        $progress->id_pegawai = $uid;
        $progress->kegiatan = $request->kegiatan;
        $progress->progress = $presentase;
        $progress->keterangan = $request->keterangan;
        $progress->save();

        /*
         * Mencatat kegiatan yang dilakukan ke tabel log.
         */
        $log = new Log();

        $log->id_pegawai = $request->user()->id;
        $log->data = "memasukkan progress di proyek " . $request->kode_proyek;
        $log->save();

        Session::flash('message', 'Progress berhasil dimasukkan');

        return redirect()->route('proyek.show', $request->kode_proyek);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proyek =  DB::table('proyek_progress')->where('id', $id)->first();

        return view('proyek_progress.edit')->with('proyek', $proyek);
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
         * Menyimpan progress proyek.
         */
        $this->validate($request, [
            'kode_proyek' => 'required',
            'kegiatan' => 'required',
            'progress' => 'required|integer',
            'keterangan' => 'required'
        ]);

        $progress = new Proyek_Progress();

        $presentase = $request->progress;

        if($presentase > 100)
        {
            $presentase = 100;
        }

        $progress->kode_proyek = $request->kode_proyek;
        $progress->id_pegawai = $request->id_pegawai;
        $progress->kegiatan = $request->kegiatan;
        $progress->progress = $presentase;
        $progress->keterangan = $request->keterangan;
        $progress->save();

        /*
         * Mencatat kegiatan yang dilakukan ke tabel log.
         */
        $log = new Log();

        $log->id_pegawai = $request->user()->id;
        $log->data = "mengubah progress di proyek " . $request->kode_proyek;
        $log->save();

        return redirect()->route('proyek.show', ['id' => $request->kode_proyek]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $progress = Proyek_Progress::findorFail($id);

        $progress->delete();

        Session::flash('message', 'Progress berhasil dihapus');

        return redirect()->back();
    }
}
