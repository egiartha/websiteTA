@extends('layouts.layout')
@section('content')
<style>
</style>
<title>Home | Layanan Pengaduan Masyarat</title>
<!-- Jumbotron -->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        @if($aplikasi=='')
        <h1 class="display-4">Layanan Pengaduan Masyarakat</h1>
        <a href="/lapor" class="btn btn-primary lapor">Sampaikan Pengaduan Disini</a>
        @else
        <h1 class="display-4">{{$aplikasi->deskripsi_aplikasi}}</h1>
        <a href="/lapor" class="btn btn-primary lapor">Sampaikan Pengaduan Disini</a>
        @endif
    </div>
</div>
<!-- akhir Jumbotron -->

<main>
    <section class="section mb-5">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    Laporan Pengaduan
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($pengaduan as $value)
                        <div class="col-md-12 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <th style="vertical-align:top;">Nama Pelapor</th>
                                                        <td style="vertical-align:top;">:</td>
                                                        <td>{{$value->nama}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="vertical-align:top;">Pada Tanggal</th>
                                                        <td style="vertical-align:top;">:</td>
                                                        <td>{{$value->tgl_pengaduan}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="vertical-align:top;">Status</th>
                                                        <td style="vertical-align:top;">:</td>
                                                        <td>{{$value->status === '0'?"belum diproses":$value->status}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th style="vertical-align:top;">Alamat</th>
                                                        <td style="vertical-align:top;">:</td>
                                                        <td>{{$value->alamat}}, {{$value->desa}}, Kec. {{$value->kecamatan}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td><a target="_blank" href="http://maps.google.com/maps?q={{$value->latitude}},{{$value->longitude}}">Lihat di Google Maps</a></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="vertical-align:top;">Isi Laporan</th>
                                                        <td style="vertical-align:top;">:</td>
                                                        <td>{{$value->isi_laporan}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><button data-toggle="modal" data-id="{{$value->kode_pengaduan}}" data-target="#modal" class="btn btn-primary my-3 komentar">Tambahkan Komentar</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-4">
                                            <img style="width:100%;" src="{{ asset('database/foto_selesai').'/'. $value->foto_pengaduan}}" alt="foto selesai">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambahkan Komentar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/komentar/store" method="POST">
                @csrf
                <input type="hidden" id="kode" name="id_pengaduan">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Komentar</label>
                        <textarea name="komentar" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.komentar').click(function() {
            let val = $(this).data('id');
            $('#kode').val(val);
        })
    })
</script>
@endpush
