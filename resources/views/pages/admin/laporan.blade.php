@extends('layout.app')
@section('title', 'Laporan Distribusi Data')
@section('laporan-active', 'active')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Laporan Barang</h1>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                    <h4>Laporan Distribusi Barang</h4>
                    </div>
                        <form action="{{ url('laporan-distribusi') }}" method="GET">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col md-6">
                                        <label for="" class="col-form-label font-weight-bold">Tanggal Awal</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border-1"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="date" name="tglaw" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col md-6">
                                        <label for="" class="col-form-label font-weight-bold">Tanggal Akhir</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border-1"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="date" name="tglak" class="form-control" required />
                                        </div>
                                    </div>
                            </div>
                    
                            <div class="card-footer text-right">
                                <button name="lihat" class="btn btn-info" type="submit"><i class="fas fa-fw fa-check mr-1"></i> Cetak Laporan</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                        <h4>Laporan Peminjaman Barang</h4>
                        </div>
                        <form action="{{ url('laporan-peminjaman') }}" method="GET">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col md-6">
                                        <label for="" class="col-form-label font-weight-bold">Tanggal Awal</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border-1"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="date" name="tglawal" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="col md-6">
                                        <label for="" class="col-form-label font-weight-bold">Tanggal Akhir</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border-1"><i class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="date" name="tglakhir" class="form-control" required />
                                        </div>
                                    </div>
                            </div>
                    
                            <div class="card-footer text-right">
                                <button class="btn btn-info" type="submit"><i class="fas fa-fw fa-check mr-1"></i> Cetak Laporan</button>
                            </div>
                        </form>
                    </div>
                    </div>

        </section>
    </div>
@endsection