@extends('layouts.app')

@section('title')
    Manajemen User
    @endsection

@section('content')
    <div class="col-lg-12">
        <div class="page-header">
            <a href="{{ route('user.create') }}" class="btn btn-default pull-right">User Baru</a>
            <h2>Manajemen User</h2>
        </div>
        <div class="scroll">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
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
            {{ $users->links() }}
        </div>
    </div>
    @endsection