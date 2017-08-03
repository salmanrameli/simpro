<?php

namespace App\Http\Controllers;

use App\Dokumen;
use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_proyek' => 'required',
            'nama_dokumen' => 'required',
            'dokumen' => 'required'
        ]);

        $dokumen = new Dokumen();

        $file = $request->file('dokumen');
        $filename = $file->getClientOriginalName();
        $filetype = $file->getClientMimeType();
        $path = storage_path(). '/proyek/'. $request->kode_proyek . '/';
        $file->move($path, $filename);

        $dokumen->nama_dokumen = $request->nama_dokumen;
        $dokumen->dokumen = $filename;
        $dokumen->kode_proyek = $request->kode_proyek;
        $dokumen->id_pegawai = Auth::id();
        $dokumen->tipe = $filetype;
        $dokumen->save();

        $log = new Log();

        $log->id_pegawai = Auth::id();
        $log->data = "upload file proyek " . $request->kode_proyek . " nama " . $filename;
        $log->save();

        Session::flash('message', 'File sukses diupload');

        return redirect()->route('proyek.show', $request->kode_proyek);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $kode)
    {
        $nama = DB::table('dokumen')->where('id', $id)->value('dokumen');

        return response()->file(storage_path("/proyek/{$kode}/{$nama}"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $kode)
    {
        $tabel = Dokumen::findorFail($id);

        $nama = DB::table('dokumen')->where('id', $id)->value('dokumen');

        unlink(storage_path('/proyek/'. $kode . '/' . $nama));

        $tabel->delete();

        $log = new Log();

        $log->id_pegawai = Auth::id();
        $log->data = "menghapus file proyek " . $kode . " nama " . $nama;
        $log->save();

        Session::flash('message', 'Dokumen berhasil dihapus');

        return redirect()->back();
    }

    public function download($id, $kode)
    {
        $nama = DB::table('dokumen')->where('id', $id)->value('dokumen');

        $log = new Log();

        $log->id_pegawai = Auth::id();
        $log->data = "download file proyek " . $kode . " nama " . $nama;
        $log->save();

        return response()->download(storage_path("/proyek/{$kode}/{$nama}"));
    }
}
