@extends('layouts.app')

@section('title')
    Ubah Proyek
    @endsection()

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Ubah Proyek</div>

        <div class="panel-body">
            {{ Form::model($proyek, ['method' => 'PATCH', 'route' => ['proyek.update', $proyek->kode_proyek]]) }}

            <div class="form-group hidden">
                {{ Form::text('kode_proyek_lama', $proyek->kode_proyek, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('kode_proyek', 'ID Proyek', ['class' => 'control-label']) }}
                {{ Form::text('kode_proyek', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('nama_proyek', 'Nama Proyek', ['class' => 'control-label']) }}
                {{ Form::text('nama_proyek', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('deskripsi_proyek', 'Deskripsi Proyek', ['class' => 'control-label']) }}
                {{ Form::text('deskripsi_proyek', null, ['class' => 'form-control']) }}
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
    @endsection()