@extends('layouts.app')

@section('title')
    Proyek - Hapus Anggota
    @endsection

@section('content')
    <div class="page-header">
        <h2>Hapus Anggota Proyek</h2>
    </div>
    {{--{{ Form::label(null, 'Anggota Proyek:', ['class' => 'control-label']) }}--}}

    {{ Form::open(['route' => ['proyek.hapus_anggota', $kode]]) }}
    <div class=scrollable>
        <table class="table table-striped">
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ Form::checkbox('anggota[]', $user->id_pegawai) }}</td>
                    <td>{{ $user->id_pegawai }}</td>
                    <td>{{ $user->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ Form::submit('Hapus', ['class' => 'btn btn-danger']) }}
    {{ Form::close() }}
    @endsection