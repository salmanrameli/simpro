@extends('layouts.app')

@section('title')
    Kegiatan Baru
    @endsection

@section('content')
    <div class="page-header">
        <h1>Buat Kegiatan Baru</h1>
    </div>
    {{--<button class="btn btn-default pull-right" id="tombol">Tambah Anggota Kegiatan</button><br>--}}

    {{ Form::open(['route' => 'kegiatan.store']) }}
    <div class="col-lg-6">
        <div class="form-group">
            {{ Form::label('nama_proyek', 'Nama Kegiatan', ['class' => 'control-label']) }}
            {{ Form::text('nama_proyek', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('deskripsi_proyek', 'Deskripsi Kegiatan', ['class' => 'control-label']) }}
            {{ Form::textarea('deskripsi_proyek', null, ['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('tanggal_mulai', 'Tanggal Mulai', ['class' => 'control-label']) }}
            {{ Form::date('tanggal_mulai', null, ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD']) }}
        </div>

        <div class="form-group">
            {{ Form::label('tanggal_target_selesai', 'Tanggal Target Selesai', ['class' => 'control-label']) }}
            {{ Form::date('tanggal_target_selesai', null, ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD']) }}
        </div>

        <div id="list_pegawai" class="hidden">

        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-inline">
            <label for="lastname" class="control-label">Nama</label>
            <select class="form-control" name="pilih_pegawai" id="pilih_pegawai" data-parsley-required="true">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" id="nama[]">{{ $user->id }} - {{ $user->name }}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-primary" onclick="tambah_anggota()">Tambah</button>
            <button type="button" class="btn btn-danger" onclick="hapus()">Kurangi</button><br><br>
        </div>
        <ol id="list" class="row">

        </ol>

        <br>
        {{ Form::submit('Daftarkan Kegiatan', ['class' => 'btn btn-primary pull-right']) }}
        {{ Form::close() }}
    </div>

@endsection

@section('js')
    <script>
        function tambah_anggota()
        {
            var listbox = document.getElementById("pilih_pegawai");
            var id_pegawai = listbox.options[listbox.selectedIndex].value;
            var nama_pegawai = listbox.options[listbox.selectedIndex].text;
            nama_pegawai = nama_pegawai.split("-");
            var input = document.createElement('input');
            input.setAttribute('type', 'text');
            input.setAttribute('value', id_pegawai);
            input.setAttribute('name', 'anggota[]');
            input.setAttribute('id', 'anggota[]');
            $('#list_pegawai').append(input);
            $('#list').append('<li>' + nama_pegawai[1] + '</li>');
        }

        function hapus()
        {
            $('#list').children().last().remove();
            $('#list_pegawai').children().last().remove();
        }
    </script>
    <script>
        $(function () {
            $('#tombol').on('click', function () {
                $('<label for="nama">Nama</label>\n' +
                    '        <select class="form-control" name="nama[]" id="nama" data-parsley-required="true">\n' +
                    '          @foreach ($users as $user) \n' +
                    '          {\n' +
                    '            <option value="{{ $user->id }}" id="nama[]">{{ $user->name }}</option>\n' +
                    '          }\n' +
                    '          @endforeach\n' +
                    '        </select><br>\n').appendTo('#list_anggota');
            });
        });
    </script>
    @endsection