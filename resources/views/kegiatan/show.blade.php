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
                                                <a href="{{ route('subtask.pindah_kiri', $ongoing->id) }}" class="pull-right" data-toggle="tooltip" title="Kembalikan ke To-do" onclick="return confirm('Hapus subtask?')"><span class="glyphicon glyphicon-ban-circle">&nbsp;</span></a>
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
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>
                    </div>

                    <div id="anggota" class="tab-pane fade">
                        <br>
                        <h3>PIC</h3>
                        <br>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Personnel Number</th>
                                <th>Nama</th>
                                <th>E-Mail</th>
                                <th>Telepon</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($anggotas as $anggota)
                                <tr>
                                    <td>{{ $anggota->id }}</td>
                                    <td>{{ $anggota->name }}</td>
                                    <td>{{ $anggota->email }}</td>
                                    <td>{{ $anggota->telepon }}</td>
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
                                        @if($dokumen->id == \Illuminate\Support\Facades\Auth::id())
                                        <a onclick="return confirm('Hapus dokumen dari proyek?')" href="{{ route('dokumen.destroy', [$dokumen->id, $kode]) }}" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-trash"></span></a>
                                        <a href="{{ route('dokumen.download', [$dokumen->id, $kode]) }}" class="btn btn-default pull-right"><span class="glyphicon glyphicon-save-file"></span> Download</a>
                                            @endif
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
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection()