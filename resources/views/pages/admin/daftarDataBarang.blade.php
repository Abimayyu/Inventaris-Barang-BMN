@extends('layout.app')
@section('title', 'Tambah Data')
@section('dataBarang-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Daftar Data Barang</h1>
    </div>

    <div class="section-body">
        <div class="card" style="width : 70%;">
            <div class="card-body">
                <form method="POST" action="{{ url('daftar-data-barang-aksi') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" class="form-control {{ $errors->has('nama_barang') ? 'is-invalid' : '' }}">
                        @if($errors->has('nama_barang'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nama_barang') }}
                        </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label>Merk Barang</label>
                        <input type="text" name="merk_barang" value="{{ old('merk_barang') }}" class="form-control {{ $errors->has('merk_barang') ? 'is-invalid' : '' }}">
                        @if($errors->has('merk_barang'))
                        <div class="invalid-feedback">
                            {{ $errors->first('merk_barang') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Tahun Pembelian</label>
                        <input type="number" name="tahun_pembelian" class="form-control {{ $errors->has('tahun_pembelian') ? 'is-invalid' : '' }}">
                        @if($errors->has('tahun_pembelian'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tahun_pembelian') }}
                        </div>
                        @endif
                    </div>
  
                    

                    <button type="submit" class="btn btn-primary">Simpan</button>
    
                </form>
            </div>
        </div>
    
    </div>
</section>
</div>
@endsection