@extends('layouts.app')

@section('title')
    Ubah Password
    @endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Ubah Password</div>

        <div class="panel-body">
            <form action="{{ route('user.simpan_password') }}" method="post" role="form" class="form-horizontal">
                {{csrf_field()}}

                <div class="form-group{{ $errors->has('old') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password Lama</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="old">

                        @if ($errors->has('old'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('old') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password Baru</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-success form-control">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection