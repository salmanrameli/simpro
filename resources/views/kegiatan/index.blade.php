@extends('layouts.app')

@section('title')
    Kegiatan
    @endsection

@section('content')

    <div id="id_user" class="hidden">{{ \Illuminate\Support\Facades\Auth::id() }}</div>

    <div class="row">
        <a href="{{ route('kegiatan.create') }}" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-plus"></span> Aktivitas Baru</a>
        <h1>Kegiatan</h1><hr>

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

    <table class="table">
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
    </table>
    <div class="scroll">
        <table class="table" id="tabel">
            @foreach($proyeks as $proyek)
                <tr class="Entries">
                    <td id="col_kode_kegiatan">{{ $proyek->kode_kegiatan }}</td>
                    <td id="col_nama_kegiatan">{{ $proyek->nama_kegiatan }}</td>
                    <td id="col_nama_pemilik">{{ $proyek->name }}</td>
                    <td id="col_tanggal_mulai">{{ $proyek->tanggal_mulai }}</td>
                    <td id="target_selesai; col_target_selesai">{{ $proyek->tanggal_target_selesai }}</td>
                    <td id="col_status"></td>
                    <td id="col_tombol_detail"><a href="{{ route('kegiatan.show', ['id' => $proyek->kode_kegiatan]) }}" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Detail</a></td>
                    <td class="hidden">{{ $proyek->tanggal_mulai }}</td>
                    <td class="hidden">{{ $proyek->id_pemilik_kegiatan }}</td>
                    <td class="hidden">{{ $proyek->tanggal_realisasi }}</td>
                </tr>
            @endforeach
        </table>
        <div class="hidden">{{ $proyeks->links() }}</div>
    </div>

@endsection

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
            var tanggal_target = $tds.eq(9).text();
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

            if((curdate > tanggal_selesai) && (tanggal_target === '0000-00-00'))
            {
                $(this).find('td').eq(x).html('<td style="text-align:center; padding: 6px; background-color: red; color:white;" width="100px"> Terlambat</td>');
            }
            else if(tanggal_target !== '0000-00-00')
            {
                $(this).find('td').eq(x).html('<td style="text-align:center;padding: 6px; background-color: #4cd12c; color:white;" width="100px"> Selesai</td>');
            }
            else {
                $(this).find('td').eq(x).html('<td style="text-align:center;padding: 6px; background-color: #ffcc00; color:black;" width="100px"> On Progress</td>');
            }

        });

        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() === $(document).height()) {

            }
        });
    </script>
    <script>
        $(function() {
            $('.scroll').jscroll({
                autoTrigger: true,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.scroll',
                callback: function() {
                    $('ul.pagination:visible:first').hide();
                }
            });
        });
    </script>

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
        function label()
        {
            table.find('tr').each(function (i) {
                var $tds = $(this).find('td');
                var tanggal_mulai = $tds.eq(3).text();
                var tanggal_target = $tds.eq(9).text();
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

                if((curdate > tanggal_selesai) && (tanggal_target === '0000-00-00'))
                {
                    $(this).find('td').eq(x).html('<td style="text-align:center; padding: 6px; background-color: red; color:white;" width="100px"> Terlambat</td>');
                }
                else if(tanggal_target !== '0000-00-00')
                {
                    $(this).find('td').eq(x).html('<td style="text-align:center;padding: 6px; background-color: #4cd12c; color:white;" width="100px"> Selesai</td>');
                }
                else {
                    $(this).find('td').eq(x).html('<td style="text-align:center;padding: 6px; background-color: #ffcc00; color:black;" width="100px"> On Progress</td>');
                }

            });
        }
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