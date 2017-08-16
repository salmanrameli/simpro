@extends('layouts.app')

@section('title')
    Profil {{ $user->name }}
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Profil {{ $user->name }}</div>

        <div class="panel-body">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>E-Mail</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $user->alamat }}</td>
                </tr>
                <tr>
                    <th>Telepon</th>
                    <td>{{ $user->telepon }}</td>
                </tr>
            </table>
            {{ Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id]]) }}
            {{ Form::submit('Hapus Akun', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Hapus Akun?")']) }}
            {{ Form::close() }}
        </div>
    </div>
@endsection