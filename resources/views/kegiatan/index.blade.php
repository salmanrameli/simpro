@extends('layouts.app')

@section('title')
    Kegiatan
    @endsection

@section('navbar')
    @if(\Illuminate\Support\Facades\Auth::user()->jabatan_id == '1')
        <li><a href="{{ route('user.manajemen') }}">Manajemen User</a></li>
    @endif
        <li class="active"><a href="{{ route('kegiatan.index') }}">Kegiatan</a></li>
@endsection

@section('content')

    <div id="id_user" class="hidden">{{ \Illuminate\Support\Facades\Auth::id() }}</div>

    <div class="row">
       <div class="page-header">
           <a href="{{ route('kegiatan.create') }}" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span> Aktivitas Baru</a>
           <h2>Kegiatan</h2>
       </div>

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
            <label for="cari" class="control-label" style="padding-left: 18px">Cari di: </label>
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

    {{ $proyeks->links() }}

    <div class="scroll">
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
            @foreach($proyeks as $proyek)
                <tr class="Entries">
                    <td id="col_kode_kegiatan">{{ $proyek->kode_kegiatan }}</td>
                    <td id="col_nama_kegiatan">{{ $proyek->nama_kegiatan }}</td>
                    <td id="col_nama_pemilik">{{ $proyek->name }}</td>
                    <td id="col_tanggal_mulai">{{ $proyek->tanggal_mulai }}</td>
                    <td id="target_selesai" style="text-align: center">{{ $proyek->tanggal_target_selesai }}</td>
                    <td id="col_status"></td>
                    <td id="col_tombol_detail"><a href="{{ route('kegiatan.show', ['id' => $proyek->kode_kegiatan]) }}" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Detail</a></td>
                    <td class="hidden">{{ $proyek->tanggal_mulai }}</td>
                    <td class="hidden">{{ $proyek->id_pemilik_kegiatan }}</td>
                    <td class="hidden">{{ $proyek->tanggal_realisasi }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('js')
    <script>
        /*
        Javascript untuk mengatur status proyek – on-track atau terlambat – dan memberikan warna background yang sesuai
         */
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

            if(tanggal_mulai !== '0000-00-00')
            {
                $tds.eq(3).html('<td>' + curr_date + ' ' + monthNames[curr_month] + ' ' + curr_year + '<td>');
            }
            else
            {
                $tds.eq(3).html('<td style="align-items: center"> <i>Undefined</i> <td>');
            }


            var target_selesai = $tds.eq(4).text();
            d = new Date(target_selesai);
            var fin_date = d.getDate();
            var fin_month = d.getMonth(); //Months are zero based
            var fin_year = d.getFullYear();

            if(target_selesai !== '0000-00-00')
            {
                $tds.eq(4).html('<td>' + fin_date + ' ' + monthNames[fin_month] + ' ' + fin_year + '<td>');
            }
            else
            {
                $tds.eq(4).html('<td style="align-items: center"> <i>Undefined</i> <td>');
            }


            var curdate = new Date().toISOString().substring(0, 10);

            var x = 9;

            if(tanggal_mulai !== '0000-00-00' && target_selesai !== '0000-00-00')
            {
                if((curdate > target_selesai) && (tanggal_realisasi === '0000-00-00'))
                {
                    var selisih = (new Date(curdate) - new Date(target_selesai))/oneDay;

                    if(selisih >= 30)
                    {
                        selisih = Math.round(selisih/28);

                        $(this).find('td').eq(x).html('<td style="text-align:center; padding: 6px; background-color: red; color:white;" width="100px"> Terlambat (' + selisih + ' Bulan)</td>');

                    }
                    else if(selisih / 7 >= 1)
                    {
                        selisih = Math.round(selisih / 7);

                        $(this).find('td').eq(x).html('<td style="text-align:center; padding: 6px; background-color: red; color:white;" width="100px"> Terlambat (' + selisih + ' Minggu)</td>');

                    }
                    else
                    {
                        $(this).find('td').eq(x).html('<td style="text-align:center; padding: 6px; background-color: red; color:white;" width="100px"> Terlambat (' + selisih + ' Hari)</td>');

                    }

                }
                else if(tanggal_realisasi !== '0000-00-00')
                {
                    $(this).find('td').eq(x).html('<td style="text-align:center;padding: 6px; background-color: #4cd12c; color:white;" width="100px"> Selesai</td>');
                }
                else {
                    $(this).find('td').eq(x).html('<td style="text-align:center;padding: 6px; background-color: #ffcc00; color:black;" width="100px"> On Progress</td>');
                }
            }
            else
            {
                $(this).find('td').eq(x).html('<td style="text-align:center;padding: 6px;" width="100px"> None</td>');
            }

        });

        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() === $(document).height()) {

            }
        });
    </script>

    <script>
        /*
        Javascript untuk melakukan filter tabel berdasarkan menu dropdown yang dipilih oleh user
         */
        $(document).ready(function($) {
            var dataset = $('#tabel').find('tbody').find('tr');

            $('#sortlist').change(function() {
                var selection = $(this).val();

                switch (selection)
                {
                    case 'none':
                        dataset.show();
                        break;

                    case 'milik_saya':
                        var filter = $('#id_user').text();

                        dataset.show();

                        dataset.filter(function(index, item) {
                            return $(item).find('td:nth-child(9)').text().toUpperCase().indexOf(filter) === -1;
                        }).hide();
                        break;

                    case 'now':
                        var date = new Date();
                        var d = date.getDate();
                        if(d < 10)
                        {
                            d = '0' + d;
                        }
                        var m = date.getMonth() + 1;
                        if(m < 10)
                        {
                            m = '0' + m;
                        }
                        var y = date.getFullYear();
                        var current = y + '-' + m + '-' + d;

                        dataset.show();

                        dataset.filter(function(index, item) {
                            return $(item).find('td:nth-child(8)').text().toUpperCase().indexOf(current) === -1;
                        }).hide();
                        break;

                    default:
                        dataset.show();
                        break;
                }

            });
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