@extends('layouts.app')

@section('title')
    Proyek - Tambah Anggota
    @endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Proyek - Tambah Anggota</div>

        <div class="panel-body">
            {{ Form::open(['route' => ['kegiatan', $kode]]) }}

            {{--<div class="form-group">--}}
                {{--{{ Form::text('id', $kode, ['class' => 'form-control']) }}--}}
            {{--</div>--}}

            <div class="form-group hidden">
                {{ Form::text('nama_proyek', $nama_proyek, ['class' => 'form-control']) }}
            </div>

            <div class="scrollable-extended">
                <table class="table table-striped">
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ Form::checkbox('anggota[]', $user->id) }}</td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{ Form::submit('Tambah Anggota', ['class' => 'btn btn-success']) }}
            {{ Form::close() }}
        </div>
    </div>
    @endsection()