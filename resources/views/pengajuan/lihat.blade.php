@extends('layouts.admin')
@section('content')
<title>Detail Data Pengajuan | Layanan Pengaduan Masyarakat</title>
<div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="data-tab" data-toggle="tab" href="#data" role="tab" aria-controls="data" aria-selected="true">Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pengajuan-tab" data-toggle="tab" href="#pengajuan" role="tab" aria-controls="pengajuan" aria-selected="false">Pengajuan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tanggapan-tab" data-toggle="tab" href="#tanggapan" role="tab" aria-controls="tanggapan" aria-selected="false">Tanggapan</a>
                    </li>
                </ul>
                @foreach($pengaduan as $value)
                <div class="tab-content">
                    <div class="tab-pane active" id="data" role="tabpanel" aria-labelledby="data-tab">
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Tanggal dibuat</th>
                                    <td>:</td>
                                    <td>{{$value->tgl_pengaduan}} </td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td>:</td>
                                    <td>{{$value->nik}} </td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap :</th>
                                    <td>:</td>
                                    <td>{{$value->nama}} </td>
                                </tr>
                                <tr>
                                    <th>Kategori Pengaduan</th>
                                    <td>:</td>
                                    <td>{{$value->kategori}} </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:</td>
                                    <td>{{$value->status==="0"?'belum diproses':$value->status}} </td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top;">Lokasi</th>
                                    <td style="vertical-align: top;">:</td>
                                    <td>
                                        <div style="height: 400px; width: 100%;" id="mapId"></div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="pengajuan" role="tabpanel" aria-labelledby="pengajuan-tab">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <img src="{{url('/database/foto_pengaduan/'. $value->foto_pengaduan)}}" alt="" width="250">
                                </div>
                                <div class="col-lg-8">
                                    <p>Laporan: {{$value->isi_laporan}}</p>
                                    <p>Alamat Lokasi Laporan: {{$value->isi_laporan}}</p>
                                    <p>Desa: {{$value->isi_laporan}}</p>
                                    <p>Kecamatan: {{$value->isi_laporan}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tanggapan" role="tabpanel" aria-labelledby="tanggapan-tab">
                        <div class="card-body">
                            @if($value->tanggapan == '0')
                            <center>
                                <i class="fas fa-exclamation-circle"> Tidak ada tanggapan</i>
                            </center>
                            @else
                            <table class="table table-striped">
                                <tr>
                                    <th>Tanggapan</th>
                                    <td>:</td>
                                    <td>{{$value->tanggapan}} </td>
                                </tr>
                                <tr>
                                    <th>Petugas</th>
                                    <td>:</td>
                                    <td>{{$petugas->nama}} </td>
                                </tr>
                                <tr>
                                    <th style="vertical-align: top;">Foto Perbaikan</th>
                                    <td style="vertical-align: top;">:</td>
                                    <td><img style="width:500px;" src="{{ asset('database/foto_selesai').'/'. $value->foto_selesai}}" alt="foto selesai"></td>
                                </tr>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    $(document).ready(function() {
        $('#example').DataTable();


        const mark = ["{{$pengaduan[0]->latitude}}", "{{$pengaduan[0]->longitude}}"]

        const map = L.map('mapId', {
            center: mark,
            zoom: 16
        })

        marker = L.marker(mark).addTo(map)

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map)
    });
</script>
@endpush
@endsection
