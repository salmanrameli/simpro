@extends('layouts.app')

@section('title')
    {{ $deskripsi->nama_kegiatan }}
@endsection

@section('navbar')
    @if(\Illuminate\Support\Facades\Auth::user()->jabatan_id == '1')
        <li><a href="{{ route('user.manajemen') }}">Manajemen User</a></li>
    @endif
    <li class="active"><a href="{{ route('kegiatan.index') }}">Kegiatan</a></li>
@endsection

@section('content')
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>{{ $deskripsi->nama_kegiatan }}</h3>
                <hr>
                <h5>Deskripsi Kegiatan:</h5>
                <p>{{ $deskripsi->deskripsi_kegiatan }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Pimpinan PIC</th>
                            <td>{{ $deskripsi->name }}</td>
                        </tr>
                        <tr>
                            <th>Kode Kegiatan</th>
                            <td>{{ $kode }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Mulai</th>
                            @if($deskripsi->tanggal_mulai != '0000-00-00')
                                <td>{{ date('d F, Y', strtotime($deskripsi->tanggal_mulai)) }}</td>
                                @else
                                <td>0000-00-00</td>
                            @endif
                        </tr>
                        <tr>
                            <th>Target Selesai</th>
                            @if($deskripsi->tanggal_target_selesai != '0000-00-00')
                                <td>{{ date('d F, Y', strtotime($deskripsi->tanggal_target_selesai)) }}</td>
                            @else
                                <td>0000-00-00</td>
                            @endif
                        </tr>
                    @if($deskripsi->tanggal_realisasi != '0000-00-00')
                        <tr>
                            <th>Tanggal Realisasi</th>
                            <td>{{ date('d F, Y', strtotime($deskripsi->tanggal_realisasi)) }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <a href="{{ route('kegiatan.edit', $kode) }}" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-edit"></span> Ubah Kegiatan</a>
                @if($deskripsi->tanggal_realisasi != '0000-00-00')
                    <a href="{{ route('kegiatan.belum_selesai', $kode) }}" class="btn btn-danger pull-right" onclick="return confirm('Tandai kegiatan belum selesai?')"><span class="glyphicon glyphicon-warning-sign"></span>Tandai Kegiatan Belum Selesai</a>
                    @elseif($deskripsi->tanggal_realisasi == '0000-00-00')
                    <a href="{{ route('kegiatan.tandai_selesai', $kode) }}" class="btn btn-primary pull-right" onclick="return confirm('Tandai kegiatan selesai?')"><span class="glyphicon glyphicon-ok"></span> Tandai Selesai</a>
                @endif
            </div>
        </div>
    </div>
    <br>

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#progress"><span class="glyphicon glyphicon-stats"></span> Progress</a></li>
                    <li><a data-toggle="tab" href="#req_selesai"><span class="glyphicon glyphicon-list"></span> Request Selesai</a></li>
                    <li><a data-toggle="tab" href="#anggota"><span class="glyphicon glyphicon-user"></span> PIC</a></li>
                    <li><a data-toggle="tab" href="#upload"><span class="glyphicon glyphicon-upload"></span> Upload</a></li>
                    <li><a data-toggle="tab" href="#download"><span class="glyphicon glyphicon-paperclip"></span> Dokumen</a></li>
                </ul>

                <div class="tab-content">
                    <div id="progress" class="tab-pane fade in active">
                        <br>
                        <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#progress_baru"><span class="glyphicon glyphicon-plus"></span> Subtask Baru</button>
                        <div id="progress_baru" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Progress Proyek</h4>
                                    </div>

                                    {{ Form::open(['route' => 'subtask.store', 'files' => 'true']) }}
                                    <div class="modal-body row">
                                        <div class="col-lg-6">
                                            <div class="form-group hidden">
                                                {{ Form::text('kode_proyek', $kode, ['class' => 'form-control']) }}
                                            </div>

                                            <div class="form-group">
                                                {{ Form::label('nama_tugas', 'Nama Subtask', ['class' => 'control-label']) }}
                                                {{ Form::text('nama_subtask', null, ['class' => 'form-control']) }}
                                            </div>

                                            <hr>
                                            <h4>Upload Dokumen (Opsional)</h4><br>
                                            <div class="form-group">
                                                {{ Form::label('judul', 'Judul Dokumen', ['class' => 'control-label']) }}
                                                {{ Form::text('judul_dokumen', null, ['class' => 'form-control']) }}
                                            </div>

                                            <div class="form-group">
                                                {{ Form::label(null, 'Pilih Dokumen', ['class' => 'control-label']) }}
                                                {{ Form::file('dokumen') }}
                                            </div>

                                            <div id="list_pegawai_subtask" class="hidden">

                                            </div>

                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-inline">
                                                <label for="lastname" class="control-label">Nama</label>
                                                <select class="form-control" name="pilih_pegawai_subtask" id="pilih_pegawai_subtask" data-parsley-required="true">
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id_pegawai }}" id="nama_anggota_subtask[]">{{ $user->id_pegawai }} - {{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-primary" onclick="tambah_anggota_subtask()">Tambah</button>
                                                <button type="button" class="btn btn-danger" onclick="hapus_anggota_subtask()">Kurangi</button><br><br>
                                            </div>
                                            <ol id="list_anggota_subtask" class="row">

                                            </ol>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{ Form::submit('Buat Subtask', ['class' => 'btn btn-primary']) }}
                                        {{ Form::close() }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <h3>Status Aktivitas</h3>
                        <br>
                        <div class="col-lg-4">
                            <div class="panel-heading" style="background-color: #00C4FB; color: white">
                                To-Do
                            </div>
                            <br>
                            <table class="table table-striped">
                                <tbody>
                                @foreach($barus as $baru)
                                    <tr>
                                        <td>
                                            <b>{{ $baru->nama_subtask }}</b>
                                            {{--<hr>--}}
                                            {{--Anggota:--}}
                                            {{--<ol>--}}
                                                {{--@foreach($subtask_anggotas as $anggota)--}}
                                                    {{--@if($baru->id == $anggota->id_subtask)--}}
                                                    {{--<li>{{ $anggota->name }}</li>--}}
                                                    {{--@endif--}}
                                                    {{--@endforeach--}}
                                            {{--</ol>--}}
                                            <div class="row" style="margin-left: 0; margin-top:10px;">
                                                <a href="{{ route('subtask.kerjakan', $baru->id) }}" class="pull-right" data-toggle="tooltip" title="Kerjakan"><span class="glyphicon glyphicon-arrow-right">&nbsp;</span></a>
                                                <a href="{{ route('subtask.destroy', $baru->id) }}" class="pull-left" data-toggle="tooltip" title="Hapus" onclick="return confirm('Hapus subtask?')"><span class="glyphicon glyphicon-trash">&nbsp</span></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-4">
                            <div class="panel-heading" style="background-color: #A62CA6; color: white">
                                In-Progress
                            </div>
                            <br>
                            <table class="table table-striped">
                                <tbody>
                                @foreach($ongoings as $ongoing)
                                    <tr>
                                        <td>
                                            <b>{{ $ongoing->nama_subtask }}</b>
                                            {{--<hr>--}}
                                            {{--Anggota:--}}
                                            {{--<ol>--}}
                                                {{--@foreach($subtask_anggotas as $anggota)--}}
                                                    {{--@if($ongoing->id == $anggota->id_subtask)--}}
                                                        {{--<li>{{ $anggota->name }}</li>--}}
                                                    {{--@endif--}}
                                                {{--@endforeach--}}
                                            {{--</ol>--}}
                                            <div class="row" style="margin-left: 0; margin-top:10px;">
                                                <a href="{{ route('subtask.pindah_kanan', $ongoing->id) }}" class="pull-right" data-toggle="tooltip" title="Request selesai"><span class="glyphicon glyphicon-ok">&nbsp;</span></a>
                                                <a href="{{ route('subtask.pindah_kiri', $ongoing->id) }}" class="pull-right" data-toggle="tooltip" title="Kembalikan ke To-do" onclick="return confirm('Kembalikan ke To Do?')"><span class="glyphicon glyphicon-ban-circle">&nbsp;</span></a>
                                                <a href="{{ route('subtask.destroy', $ongoing->id) }}" class="pull-left" data-toggle="tooltip" title="Hapus" onclick="return confirm('Hapus subtask?')"><span class="glyphicon glyphicon-trash">&nbsp;</span></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-4">
                            <div class="panel-heading" style="background-color: #75D900; color: white">
                                Selesai
                            </div>
                            <br>
                            <table class="table table-striped">
                                <tbody>
                                @foreach($selesais as $selesai)
                                    <tr>
                                        <td>
                                            <b>{{ $selesai->nama_subtask }}</b>
                                            {{--<hr>--}}
                                            {{--Anggota:--}}
                                            {{--<ol>--}}
                                                {{--@foreach($subtask_anggotas as $anggota)--}}
                                                    {{--@if($selesai->id == $anggota->id_subtask)--}}
                                                        {{--<li>{{ $anggota->name }}</li>--}}
                                                    {{--@endif--}}
                                                {{--@endforeach--}}
                                            {{--</ol>--}}
                                            <div class="row" style="margin-left: 0; margin-top:10px;">
                                                <a href="{{ route('subtask.pindah_kiri', $selesai->id) }}" class="pull-right" data-toggle="tooltip" title="Kembalikan ke In-progress" onclick="return confirm('Kembalikan ke in-progress?')"><span class="glyphicon glyphicon-ban-circle">&nbsp;</span></a>
                                                <a href="{{ route('subtask.destroy', $selesai->id) }}" class="pull-left" data-toggle="tooltip" title="Hapus" onclick="return confirm('Hapus subtask?')"><span class="glyphicon glyphicon-trash">&nbsp;</span></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="req_selesai" class="tab-pane fade">
                        <br>
                        <div class="panel-heading" style="background-color: #FDAA00; color: white">
                            Request Selesai
                        </div>
                        <br>
                        <table class="table table-striped">
                            <tbody>
                            @foreach($requests as $request)
                                <tr>
                                    <td>
                                        <b>{{ $request->nama_subtask }}</b>
                                        {{--<hr>--}}
                                        {{--Anggota:--}}
                                        {{--<ol>--}}
                                            {{--@foreach($subtask_anggotas as $anggota)--}}
                                                {{--@if($request->id == $anggota->id_subtask)--}}
                                                    {{--<li>{{ $anggota->name }}</li>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</ol>--}}
                                        <div class="row" style="margin-left: 0; margin-top:10px;">
                                            <a href="{{ route('subtask.pindah_kanan', $request->id) }}" class="pull-right" data-toggle="tooltip" title="Terima selesai"><span class="glyphicon glyphicon-ok">&nbsp;</span></a>
                                            <a href="{{ route('subtask.pindah_kiri', $request->id) }}" class="pull-right" data-toggle="tooltip" title="Tolak" onclick="return confirm('Tolak & kembalikan ke in-progress?')"><span class="glyphicon glyphicon-ban-circle">&nbsp;</span></a>
                                            <a href="{{ route('subtask.destroy', $request->id) }}" class="pull-left" data-toggle="tooltip" title="Hapus" onclick="return confirm('Hapus subtask?')"><span class="glyphicon glyphicon-trash">&nbsp;</span></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="anggota" class="tab-pane fade">
                        <br>
                        <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#modal_tambah_anggota"><span class="glyphicon glyphicon-plus"></span> Tambah Anggota</button>
                        <!-- Modal -->
                        <div id="modal_tambah_anggota" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Tambah Anggota</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-inline">
                                            <label for="lastname" class="control-label">Nama</label>
                                            <select class="form-control" name="pilih_pegawai" id="pilih_pegawai" data-parsley-required="true">
                                                @foreach ($pegawais as $pegawai)
                                                    <option value="{{ $pegawai->id }}" id="nama[]">{{ $pegawai->id }} - {{ $pegawai->name }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="btn btn-primary" onclick="tambah_anggota()">Tambah</button>
                                            <button type="button" class="btn btn-danger" onclick="hapus()">Kurangi</button><br><br>
                                        </div>
                                        <ol id="list" class="row">

                                        </ol>

                                        {{ Form::open(['route' => ['kegiatan.tambah_anggota_proyek', $kode]]) }}
                                        {{ Form::text('nama_kegiatan', $deskripsi->name, ['class' => 'hidden']) }}
                                        <div id="list_pegawai" class="hidden">

                                        </div>
                                        {{ Form::submit('Daftarkan Anggota', ['class' => 'btn btn-default']) }}
                                        {{ Form::close() }}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <h3>PIC</h3>
                        <br>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Personnel Number</th>
                                    <th>Nama</th>
                                    <th>E-Mail</th>
                                    <th>Telepon</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($anggotas as $anggota)
                                <tr>
                                    <td>{{ $anggota->id }}</td>
                                    <td>{{ $anggota->name }}</td>
                                    <td>{{ $anggota->email }}</td>
                                    <td>{{ $anggota->telepon }}</td>
                                    <td>
                                        @if($anggota->id == \Illuminate\Support\Facades\Auth::id())
                                            <a class="btn btn-danger pull-right disabled" data-toggle="tooltip" title="Anda pemilik kegiatan ini"><span class="glyphicon glyphicon-trash"></span></a>
                                            @else
                                            <a href="{{ route('kegiatan.hapus_anggota', ['id' => $kode, 'kode' => $anggota->id, ]) }}" class="btn btn-danger pull-right" onclick="return confirm('Hapus anggota dari kegiatan?')"><span class="glyphicon glyphicon-trash"></span></a>
                                            @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $anggotas->links() }}
                    </div>

                    <div id="upload" class="tab-pane fade">
                        <br>
                        <h3>Upload File</h3>
                        <br>
                        {{ Form::open(['route' => 'dokumen.store', 'files' => 'true']) }}

                        <div class="form-group hidden">
                            {{ Form::text('kode_proyek', $kode, ['class' => 'form-control']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('nama_dokumen', 'Nama Dokumen', ['class' => 'control-label']) }}
                            {{ Form::text('nama_dokumen', null, ['class' => 'form-control']) }}
                        </div>

                        <label for="nama">Nama Subtask</label>
                        <select class="form-control" name="nama" id="nama" data-parsley-required="true">
                            @foreach ($subtasks as $subtask)
                                <option value="{{ $subtask->id }}">{{ $subtask->nama_subtask }}</option>
                            @endforeach
                        </select>

                        <br>

                        <div class="form-group">
                            {{ Form::label(null, 'Pilih Dokumen', ['class' => 'control-label']) }}
                            {{ Form::file('dokumen') }}
                        </div>

                        <br>

                        {{ Form::submit('Upload', ['class' => 'btn btn-default']) }}
                        {{ Form::close() }}
                    </div>

                    <div id="download" class="tab-pane fade">
                        <br>
                        <h3>Dokumen</h3>
                        <br>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama Dokumen</th>
                                    <th>Subtask</th>
                                    <th>Tipe</th>
                                    <th>Uploader</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dokumens as $dokumen)
                                    <tr>
                                        <td>{{ date('d F, Y', strtotime($dokumen->created_at)) }}</td>
                                        <td>{{ $dokumen->judul }}</td>
                                        <td>{{ $dokumen->nama_subtask }}</td>
                                        <td>{{ $dokumen->tipe }}</td>
                                        <td>{{ $dokumen->name }}</td>
                                        <td>
                                            <a onclick="return confirm('Hapus dokumen dari kegiatan?')" href="{{ route('dokumen.destroy', [$dokumen->id, $kode]) }}" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-trash"></span></a>
                                            <a href="{{ route('dokumen.download', [$dokumen->id, $kode]) }}" class="btn btn-default pull-right"><span class="glyphicon glyphicon-save-file"></span> Download</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
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

        function tambah_anggota_subtask()
        {
            var listbox = document.getElementById("pilih_pegawai_subtask");
            var id_pegawai = listbox.options[listbox.selectedIndex].value;
            var nama_pegawai = listbox.options[listbox.selectedIndex].text;
            nama_pegawai = nama_pegawai.split("-");
            var input = document.createElement('input');
            input.setAttribute('type', 'text');
            input.setAttribute('value', id_pegawai);
            input.setAttribute('name', 'anggota_subtask[]');
            input.setAttribute('id', 'anggota_subtask[]');
            $('#list_pegawai_subtask').append(input);
            $('#list_anggota_subtask').append('<li>' + nama_pegawai[1] + '</li>');
        }

        function hapus_anggota_subtask()
        {
            $('#list_pegawai_subtask').children().last().remove();
            $('#list_anggota_subtask').children().last().remove();
        }
    </script>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    @endsection
