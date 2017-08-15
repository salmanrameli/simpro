@extends('layouts.app')

@section('title')
    Ubah Kegiatan
    @endsection()

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Ubah Proyek</div>

        <div class="panel-body">
            {{ Form::model($kegiatan, ['method' => 'PATCH', 'route' => ['kegiatan.update', $kegiatan->kode_kegiatan]]) }}

            <div class="form-group hidden">
                {{ Form::text('kode_proyek_lama', $kegiatan->kode_kegiatan, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('kode_kegiatan', 'ID Kegiatan', ['class' => 'control-label']) }}
                {{ Form::text('kode_kegiatan', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('nama_kegiatan', 'Nama Kegiatan', ['class' => 'control-label']) }}
                {{ Form::text('nama_kegiatan', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('deskripsi_kegiatan', 'Deskripsi Kegiatan', ['class' => 'control-label']) }}
                {{ Form::textarea('deskripsi_kegiatan', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('tanggal_mulai', 'Tanggal Mulai', ['class' => 'control-label']) }}
                {{ Form::date('tanggal_mulai', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('tanggal_target_selesai', 'Tanggal Target Selesai', ['class' => 'control-label']) }}
                {{ Form::date('tanggal_target_selesai', null, ['class' => 'form-control']) }}
            </div>

            {{ Form::submit('Simpan Perubahan', ['class' => 'btn btn-success']) }}
            {{ Form::close() }}
        </div>
    </div>
    @endsection