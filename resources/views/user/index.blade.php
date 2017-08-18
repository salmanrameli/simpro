@extends('layouts.app')

@section('title')
    Manajemen User
    @endsection

@section('navbar')
    @if(\Illuminate\Support\Facades\Auth::user()->jabatan_id == '1')
        <li class="active"><a href="{{ route('user.manajemen') }}">Manajemen User</a></li>
    @endif
    <li><a href="{{ route('kegiatan.index') }}">Kegiatan</a></li>
@endsection

@section('content')
    <div class="col-lg-12">
        <div class="page-header">
            <a href="{{ route('user.create') }}" class="btn btn-default pull-right">User Baru</a>
            <h2>Manajemen User</h2>
        </div>
        {{ $users->links() }}
        <div class="scroll">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Personnel Number</th>
                    <th>Nama</th>
                    <th>E-Mail</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->alamat }}</td>
                        <td>{{ $user->telepon }}</td>
                        <td><a href="{{ route('user.detail', $user->id) }}" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Detail</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection