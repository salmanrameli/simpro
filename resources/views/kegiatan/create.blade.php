@extends('layouts.app')

@section('title')
    Kegiatan Baru
    @endsection

@section('content')
    <div class="page-header">
        <h1>Buat Kegiatan Baru</h1>
    </div>
    <button class="btn btn-default pull-right" id="tombol">Tambah Anggota Kegiatan</button><br>

    {{ Form::open(['route' => 'kegiatan.store']) }}
    <div class="col-lg-6">
        <div class="form-group">
            {{ Form::label('nama_proyek', 'Nama Kegiatan', ['class' => 'control-label']) }}
            {{ Form::text('nama_proyek', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('deskripsi_proyek', 'Deskripsi Kegiatan', ['class' => 'control-label']) }}
            {{ Form::textarea('deskripsi_proyek', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('tanggal_mulai', 'Tanggal Mulai', ['class' => 'control-label']) }}
            {{ Form::date('tanggal_mulai', null, ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD']) }}
        </div>

        <div class="form-group">
            {{ Form::label('tanggal_target_selesai', 'Tanggal Target Selesai', ['class' => 'control-label']) }}
            {{ Form::date('tanggal_target_selesai', null, ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD']) }}
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group" id="list_anggota">
            {{ Form::label(null, 'Anggota:', ['class' => 'control-label']) }}
            <br>
        </div>

        <br>
        {{ Form::submit('Daftarkan Kegiatan', ['class' => 'btn btn-primary pull-right']) }}
        {{ Form::close() }}
    </div>

@endsection

@section('js')
    <script>
        $(function () {
            $('#tombol').on('click', function () {
                $('<label for="nama">Nama</label>\n' +
                    '        <select class="form-control" name="nama[]" id="nama" data-parsley-required="true">\n' +
                    '          @foreach ($users as $user) \n' +
                    '          {\n' +
                    '            <option value="{{ $user->id }}" id="nama[]">{{ $user->name }}</option>\n' +
                    '          }\n' +
                    '          @endforeach\n' +
                    '        </select><br>\n').appendTo('#list_anggota');
            });
        });
    </script>
    @endsection