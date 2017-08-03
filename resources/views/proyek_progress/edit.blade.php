@extends('layouts.app')

@section('title')
    Update Progress
    @endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Proyek - Update Progress</div>
        <div class="panel-body">
            {{ Form::model($proyek, ['method' => 'PATCH', 'route' => ['proyek_progress.update', $proyek->kode_proyek]]) }}

            <div class="form-group hidden">
                {{ Form::text('kode_proyek', $proyek->kode_proyek, ['class' => 'form-control']) }}
            </div>

            <div class="form-group hidden">
                {{ Form::text('id_pegawai', $proyek->id_pegawai, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('kegiatan', 'Kegiatan', ['class' => 'control-label']) }}
                {{ Form::text('kegiatan', $proyek->kegiatan, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('keterangan', 'Keterangan', ['class' => 'control-label']) }}
                {{ Form::text('keterangan', $proyek->keterangan, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('progress', 'Progress', ['class' => 'control-label']) }}
                {{ Form::text('progress', $proyek->progress, ['class' => 'form-control']) }}
            </div>

            {{ Form::submit('Update Progress', ['class' => 'btn btn-success']) }}
            {{ Form::close() }}

            {{--{{ Form::model($proyek, ['method' => 'PATCH', 'route' => ['proyek_progress.update', $proyek->id]]) }}--}}

            {{--<div class="form-group hidden">--}}
                {{--{{ Form::text('kode', $kode, ['class' => 'form-control']) }}--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--{{ Form::label('kegiatan', 'Kegiatan', ['class' => 'control-label']) }}--}}
                {{--{{ Form::text('kegiatan', null, ['class' => 'form-control']) }}--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--{{ Form::label('progress', 'Progress', ['class' => 'control-label']) }}--}}
                {{--{{ Form::text('progress', $proyek->progress, ['class' => 'form-control']) }}--}}
            {{--</div>--}}

            {{--<div class="form-group">--}}
                {{--{{ Form::label('progress', 'Progress', ['class' => 'control-label']) }}--}}
                {{--{{ Form::text('progress', null, ['class' => 'form-control']) }}--}}
            {{--</div>--}}

            {{--{{ Form::submit('Update Progress', ['class' => 'btn btn-success']) }}--}}
            {{--{{ Form::close() }}--}}
        </div>
    </div>
    @endsection