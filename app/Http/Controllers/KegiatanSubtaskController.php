<?php

namespace App\Http\Controllers;

use App\Dokumen;
use App\Kegiatan_Subtask;
use App\KegiatanSubtask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KegiatanSubtaskController extends Controller
{
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
        $anggotas = $request->get('nama');

        $this->validate($request, [
            'nama_tugas' => 'required',
        ]);

        if($anggotas == null)
        {
            $tugas = new Kegiatan_Subtask();
            $tugas->kode_kegiatan = $request->kode_proyek;
            $tugas->id_pembuat = Auth::id();
            $tugas->nama_subtask = $request->nama_tugas;
            $tugas->status = '0';
            $tugas->save();

            if($request->hasFile('dokumen'))
            {
                $dokumen = new Dokumen();

                $file = $request->file('dokumen');
                $filename = $file->getClientOriginalName();
                $filetype = $file->getClientMimeType();
                $path = storage_path(). '/kegiatan/'. $request->kode_proyek . '/';
                $file->move($path, $filename);

                $dokumen->nama_dokumen = $filename;
                $dokumen->dokumen = $filename;
                $dokumen->kode_proyek = $request->kode_proyek;
                $dokumen->id_pegawai = Auth::id();
                $dokumen->tipe = $filetype;
                $dokumen->save();
            }

        }
        else
        {
            foreach ($anggotas as $anggota)
            {
                $tugas = new Kegiatan_Subtask();
                $tugas->kode_kegiatan = $request->kode_proyek;
                $tugas->id_pembuat = Auth::id();
                $tugas->nama_tugas = $request->nama_tugas;
                $tugas->id_pegawai_mengerjakan = $anggota;
                $tugas->status = '0';
                $tugas->save();
            }

            if($request->hasFile('dokumen'))
            {
                $dokumen = new Dokumen();

                $file = $request->file('dokumen');
                $filename = $file->getClientOriginalName();
                $filetype = $file->getClientMimeType();
                $path = storage_path(). '/kegiatan/'. $request->kode_proyek . '/';
                $file->move($path, $filename);

                $dokumen->nama_dokumen = $request->nama_dokumen;
                $dokumen->dokumen = $filename;
                $dokumen->kode_proyek = $request->kode_proyek;
                $dokumen->id_pegawai = Auth::id();
                $dokumen->tipe = $filetype;
                $dokumen->save();
            }
        }

        Session::flash('message', 'Berhasil');

        return redirect()->route('kegiatan.show', $request->kode_proyek);
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
    public function destroy($id)
    {
        DB::table('kegiatan_subtask')->where('id', $id)->delete();

        Session::flash('message', 'Tugas berhasil dihapus');

        return redirect()->back();
    }

    public function kerjakan($id)
    {
        DB::table('kegiatan_subtask')->where('id', $id)->update(['id_pegawai_mengerjakan' => Auth::id()]);

        DB::table('kegiatan_subtask')->where('id', $id)->update(['updated_at' => Carbon::now()]);

        DB::table('kegiatan_subtask')->where('id', $id)->increment('status');

        return redirect()->back();
    }

    public function pindah_kanan($id)
    {
        DB::table('kegiatan_subtask')->where('id', $id)->increment('status');

        DB::table('kegiatan_subtask')->where('id', $id)->update(['updated_at' => Carbon::now()]);

        return redirect()->back();
    }

    public function pindah_kiri($id)
    {
        $value = DB::table('kegiatan_subtask')->where('id', $id)->value('status');

        if($value == '3')
        {
            DB::table('kegiatan_subtask')->where('id', $id)->decrement('status');

            DB::table('kegiatan_subtask')->where('id', $id)->decrement('status');
        }
        else
        {
            DB::table('kegiatan_subtask')->where('id', $id)->decrement('status');
        }

        DB::table('kegiatan_subtask')->where('id', $id)->update(['updated_at' => Carbon::now()]);

        return redirect()->back();
    }
}
