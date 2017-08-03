@extends('layouts.app')

@section('title')
    Proyek - Progress Baru
    @endsection

@section('content')
    {{ Form::open(['route' => 'proyek_progress.store']) }}

    <div class="form-group{{ $errors->has('kode_proyek') ? ' has-error' : '' }} hidden">
        <label for="kode_proyek" class="col-md-4 control-label">Kode Proyek</label>

        <div class="col-md-6">
            <input id="kode_proyek" type="text" class="form-control" name="kode_proyek" value="{{ $id }}" required>

            @if ($errors->has('kode_proyek'))
                <span class="help-block">
                    <strong>{{ $errors->first('kode_proyek') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('kegiatan', 'Kegiatan', ['class' => 'control-label']) }}
        {{ Form::text('kegiatan', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('keterangan', 'Keterangan', ['class' => 'control-label']) }}
        {{ Form::textarea('keterangan', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('progress', 'Progress', ['class' => 'control-label']) }}
        {{ Form::text('progress', null, ['class' => 'form-control']) }}
    </div>

    {{ Form::submit('Masukkan Progress', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
    @endsection()