<?php

namespace App\Http\Controllers;

use App\Proyek_Tugas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProyekTugasController extends Controller
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
        $pegawais = $request->get('pegawai');

        $this->validate($request, [
            'kode_proyek' => 'required',
            'nama_tugas' => 'required',
        ]);

        if($pegawais == null)
        {
            $tugas = new Proyek_Tugas();
            $tugas->kode_proyek = $request->kode_proyek;
            $tugas->id_pembuat = Auth::id();
            $tugas->nama_tugas = $request->nama_tugas;
            $tugas->status = '0';
            $tugas->save();
        }
        else
        {
            foreach ($pegawais as $pegawai)
            {
                $tugas = new Proyek_Tugas();
                $tugas->kode_proyek = $request->kode_proyek;
                $tugas->id_pembuat = Auth::id();
                $tugas->nama_tugas = $request->nama_tugas;
                $tugas->id_pegawai_mengerjakan = $pegawai;
                $tugas->status = '0';
                $tugas->save();
            }
        }

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
        DB::table('proyek_tugas')->where('id', $id)->delete();

        Session::flash('message', 'Tugas berhasil dihapus');

        return redirect()->back();
    }

    public function kerjakan($id)
    {
        DB::table('proyek_tugas')->where('id', $id)->update(['id_pegawai_mengerjakan' => Auth::id()]);

        DB::table('proyek_tugas')->where('id', $id)->update(['updated_at' => Carbon::now()]);

        DB::table('proyek_tugas')->where('id', $id)->increment('status');

        return redirect()->back();
    }

    public function pindah_kanan($id)
    {
        DB::table('proyek_tugas')->where('id', $id)->increment('status');

        DB::table('proyek_tugas')->where('id', $id)->update(['updated_at' => Carbon::now()]);

        return redirect()->back();
    }

    public function pindah_kiri($id)
    {
        $value = DB::table('proyek_tugas')->where('id', $id)->value('status');

        if($value == '3')
        {
            DB::table('proyek_tugas')->where('id', $id)->decrement('status');

            DB::table('proyek_tugas')->where('id', $id)->decrement('status');
        }
        else
        {
            DB::table('proyek_tugas')->where('id', $id)->decrement('status');
        }

        DB::table('proyek_tugas')->where('id', $id)->update(['updated_at' => Carbon::now()]);

        return redirect()->back();
    }
}
