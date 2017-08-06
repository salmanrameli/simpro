@extends('layouts.app')

@section('title')
    Register Proyek
    @endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Register Proyek</div>

        <div class="panel-body">
            {{ Form::open(['route' => 'proyek.store']) }}

            <div class="form-group">
                {{ Form::label('kode_proyek', 'ID Kegiatan', ['class' => 'control-label']) }}
                {{ Form::text('kode_proyek', null, ['class' => 'form-control']) }}
            </div>

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

            <br>

            {{ Form::label(null, 'Anggota:', ['class' => 'control-label']) }}
            <div class=scrollable>
                <table class="table">
                    @foreach($users as $user)
                        <tr>
                            <td>{{ Form::checkbox('anggota[]', $user->id) }}</td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <br>
            {{ Form::submit('Buat Proyek', ['class' => 'btn btn-primary']) }}
            {{ Form::close() }}

        </div>
    </div>

        @endsection