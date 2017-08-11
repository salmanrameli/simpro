@extends('layouts.app')

@section('title')
    Hasil Pencarian
    @endsection

@section('content')
    <div class="page-header">
        <h2>Hasil pencarian dengan query: {{ $query }}</h2>
    </div>
    <div class="col-lg-6">
        {{ Form::open(['url' => 'kegiatan/cari']) }}

        <div class="form-group">
            {{ Form::label('cari', 'Cari: ', ['class' => 'control-label']) }}
            {{ Form::select('kategori', ['0' => 'Semua Kolom', '1' => 'Kode Kegiatan', '2' => 'Nama Kegiatan', '4' => 'Tanggal Mulai', '5' => 'Target Selesai']) }}

            {{ Form::text('query', null, ['class' => 'form-control']) }}
        </div>

        {{ Form::submit('Cari', ['class' => 'btn btn-default pull-right']) }}
        {{ Form::close() }}
    </div>

    {{ Form::open(['url' => 'kegiatan/cari/tanggal']) }}

    <div class="col-lg-3">
        {{ Form::label('cari', 'Tanggal Mulai: ', ['class' => 'control-label']) }}
        {{ Form::date('tgl_mulai', null, ['class' => 'form-control']) }}<br>
    </div>
    <div class="col-lg-3">
        {{ Form::label('cari', 'Tanggal Target Selesai: ', ['class' => 'control-label']) }}<br>
        {{ Form::date('tgl_selesai', null, ['class' => 'form-control']) }}<br>
    </div>

    {{ Form::submit('Cari', ['class' => 'btn btn-default pull-right']) }}
    {{ Form::close() }}

    <table class="table" id="tabel">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Kegiatan</th>
                <th>Nama Ketua</th>
                <th>Tanggal Mulai</th>
                <th>Target Selesai</th>
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