@extends('layouts.app')

@section('title')
    Kegiatan
    @endsection

@section('content')
    <a href="{{ route('proyek.create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-file"></span> Buat Kegiatan Baru</a><br><br>

    <div id="id_user" class="hidden">{{ \Illuminate\Support\Facades\Auth::id() }}</div>

    <div class="row">
        <h1>Kegiatan</h1>
        <select id="sortlist">
            <option value="none">Pilih filter</option>
            <option value="tgl_asc">Tanggal - Ascending</option>
            <option value="tgl_desc">Tanggal - Descending</option>
            <option value="milik_saya">Kegiatan Milik Saya</option>
        </select>
        <a href="{{ route('home') }}">Reset filter</a>
        <form>
            <br>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                <input type="text" id="myInput" placeholder="Masukkan teks pencarian disini" class="form-control">
            </div>
        </form>
    </div>
    <hr>

    <table class="table" id="tabel">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nama Kegiatan</th>
            <th>Nama Ketua</th>
            <th>Tanggal Mulai</th>
            <th>Target Selesai</th>
            <th>Status</th>
            <th>Detail</th>
            <th></th>
        </tr>
        <tr>

        </tr>
        </thead>
        <tbody>
        @foreach($proyeks as $proyek)
            <tr class="Entries">
                <td>{{ $proyek->kode_proyek }}</td>
                <td>{{ $proyek->nama_proyek }}</td>
                <td>{{ $proyek->nama_pemilik_proyek }}</td>
                <td>{{ $proyek->tanggal_mulai }}</td>
                <td id="target_selesai">{{ $proyek->tanggal_target_selesai }}</td>
                <td></td>
                <td><a href="{{ route('proyek.show', ['id' => $proyek->kode_proyek]) }}" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Lihat Detail</a></td>
                <td class="hidden">{{ $proyek->tanggal_mulai }}</td>
                <td class="hidden">{{ $proyek->id_pemilik_proyek }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $proyeks->links() }}

@endsection

@section('js')
    <script>
        /*
        Javascript untuk mengatur status proyek – on-track atau terlambat – dan memberikan warna background yang sesuai
         */
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

            $tds.eq(4).html('<td>' + fin_date + ' ' + monthNames[fin_month] + ' ' + fin_year + '<td>');

            var curdate = new Date().toISOString().substring(0, 10);

            var x = 9;

            if(curdate > tanggal_selesai)
            {
                $(this).find('td').eq(x).html('<td style="padding: 6px; background-color: red; color:white;"> Terlambat</td>');
            }
            else {
                $(this).find('td').eq(x).html('<td style="padding: 6px; background-color: #4cd12c; color:white;"> On-Track</td>');
            }

        });

    </script>

    <script>
        /*
        Javascript untuk melakukan pencarian di semua kolom tabel
         */
        function filterTable(event) {
            var filter = event.target.value.toUpperCase();
            var rows = document.querySelector("#tabel tbody").rows;

            for (var i = 0; i < rows.length; i++) {
                var ColId = rows[i].cells[0].textContent.toUpperCase();
                var ColKegiatan = rows[i].cells[1].textContent.toUpperCase();
                var ColKetua = rows[i].cells[2].textContent.toUpperCase();
                var ColTglMulai = rows[i].cells[3].textContent.toUpperCase();
                var ColTglSelesai = rows[i].cells[4].textContent.toUpperCase();
                var ColTglTarget = rows[i].cells[5].textContent.toUpperCase();
                var ColStatus = rows[i].cells[6].textContent.toUpperCase();
                if (ColId.indexOf(filter) > -1 || ColKegiatan.indexOf(filter) > -1 || ColKetua.indexOf(filter) > -1 || ColTglMulai.indexOf(filter) > -1 || ColTglSelesai.indexOf(filter) > -1 || ColTglTarget.indexOf(filter) > -1 || ColStatus.indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        document.querySelector('#myInput').addEventListener('keyup', filterTable, false);
    </script>

    <script>
        /*
        Javascript untuk melakukan sorting berdasarkan menu dropdown yang dipilih oleh user
         */
        function bgChange(selectedCategory) {
            var $tbody = $('#tabel').find('tbody');

            switch (selectedCategory)
            {
                case 'none':
                    location.reload();
                    break;

                case 'tgl_asc':
                    $tbody.find('tr').sort(function(a,b){
                        var tda = $(a).find('td:eq(12)').text(); // can replace 1 with the column you want to sort on
                        var tdb = $(b).find('td:eq(12)').text(); // this will sort on the second column
                        return tda > tdb ? 1
                            : tda < tdb ? -1
                                : 0;
                    }).appendTo($tbody);
                    break;

                case 'tgl_desc':
                    $tbody.find('tr').sort(function(a,b){
                        var tda = $(a).find('td:eq(12)').text(); // can replace 1 with the column you want to sort on
                        var tdb = $(b).find('td:eq(12)').text(); // this will sort on the second column
                        return tda < tdb ? 1
                            : tda > tdb ? -1
                                : 0;
                    }).appendTo($tbody);
                    break;

                case 'milik_saya':
                    var filter = $('#id_user').text();
                    var rows = document.querySelector("#tabel tbody").rows;

                    for (var i = 0; i < rows.length; i++) {
                        var ColKetua = rows[i].cells[8].textContent.toUpperCase();

                        if (ColKetua.indexOf(filter.toUpperCase()) > -1 ) {
                            rows[i].style.display = "";
                        } else {
                            rows[i].style.display = "none";
                        }
                    }
            }
        }

        var bandCategories = document.getElementById("sortlist"),
            chooseCategoryStr = bandCategories.options[0].value;

        bandCategories.onchange = function () {
            var selectedCategory = this.value;

            if (selectedCategory !== chooseCategoryStr) {
                bgChange(selectedCategory);
            }
        };
    </script>
    @endsection