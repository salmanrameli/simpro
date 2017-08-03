@extends('layouts.app')

@section('title')
    Proyek
    @endsection

@section('content')
    <a href="{{ route('proyek.create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-file"></span> Buat Proyek Baru</a><br><br>

    <div class="panel-body">
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a data-toggle="tab" href="#berlangsung">Ongoing <span class="badge" style="background-color: red">{{ $jumlah_berlangsung }}</span></a></li>
            <li><a data-toggle="tab" href="#selesai">Selesai <span class="badge">{{ $jumlah_selesai }}</span></a></li>
        </ul>
    </div>

    <div class="tab-content">
        <div id="berlangsung" class="tab-pane fade in active">
            <h3>Proyek Ongoing</h3>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Proyek</th>
                        <th>ID Ketua</th>
                        <th>Tanggal Mulai</th>
                        <th>Target Selesai</th>
                        <th>Detail</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($proyek_bs as $proyek_b)
                    <tr>
                        <td>{{ $proyek_b->kode_proyek }}</td>
                        <td>{{ $proyek_b->nama_proyek }}</td>
                        <td>{{ $proyek_b->pemilik_proyek }}</td>
                        <td>{{ date('d F, Y', strtotime($proyek_b->tanggal_mulai)) }}</td>
                        <td>{{ date('d F, Y', strtotime($detail_proyek->tanggal_target_selesai)) }}</td>
                        <td><a href="{{ route('proyek.show', ['id' => $proyek_b->kode_proyek]) }}" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Lihat Detail</a></td>
                        @if(\Illuminate\Support\Facades\Auth::id() == $proyek_b->pemilik_proyek)
                            <td><a href="{{ route('proyek.tandai_selesai', ['id' => $proyek_b->kode_proyek]) }}" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Tandai Selesai</a></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $proyek_bs->links() }}
        </div>
        <div id="selesai" class="tab-pane fade">
            <h3>Proyek Selesai</h3>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Proyek</th>
                        <th>ID Ketua</th>
                        <th>Tanggal Mulai</th>
                        <th>Target Selesai</th>
                        <th>Tanggal Selesai</th>
                        <th>Detail</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($proyek_ss as $proyek_s)
                    <tr>
                        <td>{{ $proyek_s->kode_proyek }}</td>
                        <td>{{ $proyek_s->nama_proyek }}</td>
                        <td>{{ $proyek_s->pemilik_proyek }}</td>
                        <td>{{ date('d F, Y', strtotime($proyek_s->tanggal_mulai)) }}</td>
                        <td>{{ date('d F, Y', strtotime($detail_proyek->tanggal_target_selesai)) }}</td>
                        <td>{{ date('d F, Y', strtotime($proyek_s->tanggal_realisasi)) }}</td>
                        <td><a href="{{ route('proyek.show', ['id' => $proyek_s->kode_proyek]) }}" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Lihat Detail</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $proyek_ss->links() }}
        </div>
    </div>

@endsection