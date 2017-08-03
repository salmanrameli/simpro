@extends('layouts.app')

@section('title')
    Register Akun Baru
    @endsection

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('user.store') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
            <label for="id" class="control-label">ID</label>

            <input id="id" type="text" class="form-control" name="id" value="{{ old('id') }}" required autofocus>

            @if ($errors->has('id'))
                <span class="help-block">
                        <strong>{{ $errors->first('id') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label">Nama</label>

            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
                <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
            <label for="alamat" class="control-label">Alamat</label>

            <input id="alamat" type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" required autofocus>

            @if ($errors->has('alamat'))
                <span class="help-block">
                        <strong>{{ $errors->first('alamat') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('telepon') ? ' has-error' : '' }}">
            <label for="telepon" class="control-label">Telepon</label>

            <input id="telepon" type="text" class="form-control" name="telepon" value="{{ old('telepon') }}" required autofocus>

            @if ($errors->has('telepon'))
                <span class="help-block">
                        <strong>{{ $errors->first('telepon') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('jabatan', 'Jabatan', ['class' => 'control-label']) }}<br>
            {{ Form::radio('jabatan', '1') }}
            {{ Form::label('administrator', ' Administrator', ['class' => 'control-label']) }}<br>
            {{ Form::radio('jabatan', '2') }}
            {{ Form::label('kepala divisi', ' Kepala Divisi', ['class' => 'control-label']) }}<br>
            {{ Form::radio('jabatan', '3') }}
            {{ Form::label('pegawai', ' Pegawai', ['class' => 'control-label']) }}
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label">E-Mail</label>

            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="control-label">Password</label>

            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
            @endif
        </div>

        <div class="form-group">
            <label for="password-confirm" class="control-label">Confirm Password</label>

            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Register
            </button>
        </div>
    </form>
    @endsection
