@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!<br><br>
                    <a href="{{ route('user.create') }}" class="btn btn-default btn-block">Register User</a><br>
                    <a href="{{ route('kegiatan.index') }}" class="btn btn-default btn-block">View Project</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
