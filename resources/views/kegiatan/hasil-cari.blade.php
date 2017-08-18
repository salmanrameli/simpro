@extends('layouts.app')

@section('title')
    Hasil Pencarian
    @endsection

@section('navbar')
    @if(\Illuminate\Support\Facades\Auth::user()->jabatan_id == '1')
        <li><a href="{{ route('user.manajemen') }}">Manajemen User</a></li>
    @endif
    <li class="active"><a href="{{ route('kegiatan.index') }}">Kegiatan</a></li>
@endsection

@section('content')
    <div class="page-header">
        <h2>Hasil pencarian dengan query: {{ $query }}</h2>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ url('cari') }}" method="GET">
                <div class="row">
                    <div class="form-group">
                        <label for="cari" class="control-label">Cari</label>
                        <input type="text" class="form-control" name="query" placeholder="Masukkan pencarian anda disini">
                    </div>
                    <label for="kategori" class="control-label">Cari di kolom: &nbsp;</label>
                    <select id="kategori" name="kategori">
                        <option value="0">Semua Kolom</option>
                        <option value="1">ID Kegiatan</option>
                        <option value="2">Nama Kegiatan</option>
                        <option value="3">Kepala PIC</option>
                    </select>
                    <button type="submit" class="btn btn-default pull-right">Cari</button>
                </div>
            </form>
        </div>

        <form action="{{ url('tanggal') }}" method="GET">
            <div class="col-lg-3">
                <label for="tanggal_1" class="control-label">Tanggal 1</label>
                <input type="date" class="form-control" name="tgl_mulai" placeholder="YYYY-MM-DD"><br>
            </div>
            <div class="col-lg-3">
                <label for="tanggal_2" class="control-label">Tanggal 2</label>
                <input type="date" class="form-control" name="tgl_selesai" placeholder="YYYY-MM-DD"><br>
            </div>
            <label for="cari" class="control-label" style="padding-left: 18px">Cari di Tanggal: </label>
            <select id="kategori" name="kategori">
                <option value="0">Tanggal Mulai s.d. Target Selesai</option>
                <option value="1">Tanggal Mulai</option>
                <option value="2">Tanggal Mulai 1 s.d. Tanggal Mulai 2</option>
                <option value="3">Target Selesai</option>
                <option value="4">Target Selesai 1 s.d. Target Selesai 2</option>
            </select>
            <button type="submit" class="btn btn-default pull-right">Cari</button>
        </form>
    </div>

    <br>

    {{ $results->links() }}

    <table class="table" id="tabel">
        <thead>
        <tr>
            <th id="col_kode_kegiatan">ID</th>
            <th id="col_nama_kegiatan">Nama Kegiatan</th>
            <th id="col_nama_pemilik">Kepala PIC</th>
            <th id="col_tanggal_mulai">Tanggal Mulai</th>
            <th id="col_target_selesai">Target Selesai</th>
            <th id="col_status">Status</th>
            <th id="col_tombol_detail">Detail</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($results as $result)
            <tr class="Entries">
                <td id="col_kode_kegiatan">{{ $result->kode_kegiatan }}</td>
                <td id="col_nama_kegiatan">{{ $result->nama_kegiatan }}</td>
                <td id="col_nama_pemilik">{{ $result->name }}</td>
                <td id="col_tanggal_mulai">{{ $result->tanggal_mulai }}</td>
                <td id="target_selesai" style="text-align: center">{{ $result->tanggal_target_selesai }}</td>
                <td id="col_status"></td>
                <td id="col_tombol_detail"><a href="{{ route('kegiatan.show', ['id' => $result->kode_kegiatan]) }}" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Detail</a></td>
                <td class="hidden">{{ $result->tanggal_mulai }}</td>
                <td class="hidden">{{ $result->id_pemilik_kegiatan }}</td>
                <td class="hidden">{{ $result->tanggal_realisasi }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endsection

@section('js')
    <script>
        var table = $("#tabel").find("tbody");

        var oneDay = 86400000;

        var monthNames = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
        ];

        table.find('tr').each(function (i) {
            var $tds = $(this).find('td');
            var tanggal_mulai = $tds.eq(3).text();
            var tanggal_realisasi = $tds.eq(9).text();
            var d = new Date(tanggal_mulai);
            var curr_date = d.getDate();
            var curr_month = d.getMonth(); //Months are zero based
            var curr_year = d.getFullYear();

            $tds.eq(3).html('<td>' + curr_date + ' ' + monthNames[curr_month] + ' ' + curr_year + '<td>');

            var target_selesai = $tds.eq(4).text();
            d = new Date(target_selesai);
            var fin_date = d.getDate();
            var fin_month = d.getMonth(); //Months are zero based
            var fin_year = d.getFullYear();

            $tds.eq(4).html('<td>' + fin_date + ' ' + monthNames[fin_month] + ' ' + fin_year + '<td>');

            var curdate = new Date().toISOString().substring(0, 10);

            var x = 9;

            if((curdate > target_selesai) && (tanggal_realisasi === '0000-00-00'))
            {
                var selisih = (new Date(curdate) - new Date(target_selesai))/oneDay;

                $(this).find('td').eq(x).html('<td style="text-align:center; padding: 6px; background-color: red; color:white;" width="100px"> Terlambat (' + selisih + ' Hari)</td>');
            }
            else if(tanggal_realisasi !== '0000-00-00')
            {
                $(this).find('td').eq(x).html('<td style="text-align:center;padding: 6px; background-color: #4cd12c; color:white;" width="100px"> Selesai</td>');
            }
            else {
                $(this).find('td').eq(x).html('<td style="text-align:center;padding: 6px; background-color: #ffcc00; color:black;" width="100px"> On Progress</td>');
            }

        });
    </script>
    @endsection()