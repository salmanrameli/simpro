@extends('layouts.app')

@section('title')
    Hasil Pencarian
    @endsection

@section('content')
    <div class="page-header">
        <h2>Hasil pencarian dengan query: {{ $query }}</h2>
    </div>
    <div class="row">
        <div class="col-lg-6">
            {{ Form::open(['url' => 'kegiatan/cari']) }}

            <div class="form-group">
                {{ Form::label('query', 'Cari', ['class' => 'control-label']) }}
                {{ Form::text('query', null, ['class' => 'form-control', 'placeholder' => 'Masukkan pencarian anda disini']) }}
            </div>

            {{ Form::label('cari', 'Cari di kolom:&nbsp;', ['class' => 'control-label']) }}
            {{ Form::select('kategori', ['0' => 'Semua Kolom', '1' => 'ID Kegiatan', '2' => 'Nama Kegiatan', '3' => 'Kepala PIC', '4' => 'Tanggal Mulai', '5' => 'Target Selesai']) }}

            {{ Form::submit('Cari', ['class' => 'btn btn-default pull-right']) }}
            {{ Form::close() }}
        </div>

        {{ Form::open(['url' => 'kegiatan/cari/tanggal']) }}
        <div class="col-lg-3">
            {{ Form::label('cari', 'Tanggal 1:', ['class' => 'control-label']) }}
            {{ Form::date('tgl_mulai', null, ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD']) }}<br>
        </div>

        <div class="col-lg-3">
            {{ Form::label('cari', 'Tanggal 2: ', ['class' => 'control-label']) }}<br>
            {{ Form::date('tgl_selesai', null, ['class' => 'form-control', 'placeholder' => 'YYYY-MM-DD']) }}<br>
        </div>

        {{ Form::label('cari', 'Cari di Tanggal: ', ['class' => 'control-label']) }}
        {{ Form::select('kategori', ['0' => 'Tanggal Mulai – Target Selesai', '1' => 'Tanggal Mulai', '2' => 'Tanggal Mulai 1 – Tanggal Mulai 2', '3' => 'Target Selesai', '4' => 'Target Selesai 1 – Target Selesai 2', '5' => '?']) }}

        {{ Form::submit('Cari', ['class' => 'btn btn-default pull-right']) }}
        {{ Form::close() }}
    </div>

    <br>

    <table class="table" id="tabel">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Kegiatan</th>
                <th>Nama Ketua</th>
                <th>Tanggal Mulai</th>
                <th>Target Selesai</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
                <tr>
                    <td>{{ $result->kode_kegiatan }}</td>
                    <td>{{ $result->nama_kegiatan }}</td>
                    <td>{{ $result->name }}</td>
                    <td>{{ $result->tanggal_mulai }}</td>
                    <td>{{ $result->tanggal_target_selesai }}</td>
                    <td><a href="{{ route('kegiatan.show', ['id' => $result->kode_kegiatan]) }}" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Detail</a></td>
                </tr>
                @endforeach
        </tbody>
    </table>
    @endsection()

@section('js')
    <script>
        var table = $("#tabel").find("tbody");

        var monthNames = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
        ];

        table.find('tr').each(function (i) {
            var $tds = $(this).find('td');
            var tanggal_mulai = $tds.eq(3).text();
            var tanggal_target = $tds.eq(4).text();
            var d = new Date(tanggal_mulai);
            var curr_date = d.getDate();
            var curr_month = d.getMonth(); //Months are zero based
            var curr_year = d.getFullYear();

            $tds.eq(3).html('<td>' + curr_date + ' ' + monthNames[curr_month] + ' ' + curr_year + '<td>');

            var tanggal_selesai = $tds.eq(4).text();
            d = new Date(tanggal_selesai);
            var fin_date = d.getDate();
            var fin_month = d.getMonth(); //Months are zero based
            var fin_year = d.getFullYear();

            $tds.eq(4).html('<td>' + fin_date + ' ' + monthNames[fin_month] + ' ' + fin_year + '<td>');});

    </script>
    @endsection()