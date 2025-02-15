@extends('layout.app')
@section('title', 'Edit Data')
@section('dataPeminjaman-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Edit Data Peminjaman Barang</h1>
    </div>

    <div class="section-body">
        <div class="card" style="width : 70%;">
            <div class="card-body">
                <form method="POST" action="{{ url('edit-peminjaman-barang-aksi') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Nama Peminjam</label>
                        <input type="hidden" name="id" value="{{ $peminjaman->id }}">
                        <input type="text" name="nama_peminjam" value="{{ $peminjaman->nama_peminjam }}" class="form-control {{ $errors->has('nama_peminjam') ? 'is-invalid' : '' }}">
                        @if($errors->has('nama_peminjam'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nama_peminjam') }}
                        </div>
                        @endif
                    </div>
                    <div>
                        <h6>List Barang Sekarang:</h6>
                        <?php $no = 1 ?> 
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                <th class="text-center">No</th>
                                <th>Kode Barang</th>
                                <th>Detail Barang</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach($peminjaman->detailPeminjaman as $d)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $d->dataBarang->kode_barang }}</td>
                                    <td> {{ $d->dataBarang->dataBarang->nama_barang }} (Merk {{ $d->dataBarang->dataBarang->merk_barang }}) Tahun Pembelian {{ $d->dataBarang->dataBarang->tahun_pembelian }}</td>
                                    <td>
                                     <a href="{{ url('hapus-barang-peminjaman/'.$d->id) }}" class="btn btn-danger">Hapus</a> 
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
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