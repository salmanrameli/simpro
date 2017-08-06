@extends('layouts.app')

@section('title')
    Kegiatan
    @endsection

@section('content')
    <a href="{{ route('proyek.create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-file"></span> Buat Kegiatan Baru</a><br><br>

    <div class="page-header">
        <h1>Kegiatan</h1>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nama Kegiatan</th>
            <th>ID Ketua</th>
            <th>Tanggal Mulai</th>
            <th>Target Selesai</th>
            <th>Detail</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($proyeks as $proyek)
            <tr>
                <td>{{ $proyek->kode_proyek }}</td>
                <td>{{ $proyek->nama_proyek }}</td>
                <td>{{ $proyek->pemilik_proyek }}</td>
                <td>{{ date('d F, Y', strtotime($proyek->tanggal_mulai)) }}</td>
                <td>{{ date('d F, Y', strtotime($proyek->tanggal_target_selesai)) }}</td>
                <td><a href="{{ route('proyek.show', ['id' => $proyek->kode_proyek]) }}" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Lihat Detail</a></td>
                @if(\Illuminate\Support\Facades\Auth::id() == $proyek->pemilik_proyek)
                    <td><a href="{{ route('proyek.tandai_selesai', ['id' => $proyek->kode_proyek]) }}" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Tandai Selesai</a></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $proyeks->links() }}

@endsection