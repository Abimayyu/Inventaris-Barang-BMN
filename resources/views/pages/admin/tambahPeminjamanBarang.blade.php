@extends('layout.app')
@section('title', 'Tambah Data')
@section('dataPeminjaman-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Tambah Data Peminjaman Barang</h1>
    </div>

    <div class="section-body">
        <div class="card" style="width : 70%;">
            <div class="card-body">
                <form method="POST" action="{{ url('tambah-peminjaman-barang-aksi') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Nama Peminjam</label>
                        <input type="text" name="nama_peminjam" value="{{ old('nama_peminjam') }}" class="form-control {{ $errors->has('nama_peminjam') ? 'is-invalid' : '' }}">
                        @if($errors->has('nama_peminjam'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nama_peminjam') }}
                        </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label>Pilih Barang</label>
                        <select class="form-control select2" multiple="" name="barang[]">
                            @foreach ($barang as $item)
                                @if (old('barang') == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->kode_barang }} - {{ $item->dataBarang->nama_barang }} (Merk {{ $item->dataBarang->merk_barang }}) Tahun Pembelian {{ $item->dataBarang->tahun_pembelian }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->kode_barang }} - {{ $item->dataBarang->nama_barang }} (Merk {{ $item->dataBarang->merk_barang }}) Tahun Pembelian {{ $item->dataBarang->tahun_pembelian }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if($errors->has('barang'))
                        <div class="invalid-feedback">
                            {{ $errors->first('barang') }}
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