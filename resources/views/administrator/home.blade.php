@extends('layouts.administrator')

@section('title')
    Home
@endsection

@section('content')
    <div class="row">
        <div style="text-align: center">
            <img src="{{ asset('bootstrap/img/bri-sat.jpg') }}" style="display: inline-block; " href="{{ route('home') }}">
            <div class="title" style="font-size: 32px">
                Portal Divisi Satelit Jaringan Komunikasi
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
