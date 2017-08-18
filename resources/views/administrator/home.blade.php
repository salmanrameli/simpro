@extends('layouts.administrator')

@section('title')
    Home
@endsection

@section('navbar')
    <li><a href="{{ route('user.manajemen') }}">Manajemen User</a></li>
    <li><a href="{{ route('kegiatan.index') }}">Kegiatan</a></li>
    @endsection

@section('content')
    <div class="row">
        <div style="text-align: center">
            <img src="{{ asset('bootstrap/img/bri-sat.jpg') }}" style="display: inline-block;}}">
            <div class="title" style="font-size: 32px">
                Selamat Datang, {{ \Illuminate\Support\Facades\Auth::user()->name }}
                <br><br>
            </div>
        </div>
        <div class="col-lg-6">
            <a href="{{ route('user.manajemen') }}" class="btn btn-lg btn-default custom-button-user pull-right">Manajemen User</a><br>
        </div>
        <div class="col-lg-6">
            <a href="{{ route('kegiatan.index') }}" class="btn btn-lg btn-default custom-button-project">Kegiatan</a>
        </div>
    </div>

@endsection
