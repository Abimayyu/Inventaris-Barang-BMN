@extends('layout.app')
@section('title', 'Tambah Data')
@section('distribusiDataBarang-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Tambah Data Distribusi Barang</h1>
    </div>

    <div class="section-body">
        <div class="card" style="width : 70%;">
            <div class="card-body">
                <form method="POST" action="{{ url('tambah-distribusi-aksi') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Penanggung Jawab</label>
                        <input type="text" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}" class="form-control {{ $errors->has('penanggung_jawab') ? 'is-invalid' : '' }}">
                        @if($errors->has('penanggung_jawab'))
                        <div class="invalid-feedback">
                            {{ $errors->first('penanggung_jawab') }}
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
                      {{-- <div class="form-group">
                        <label>Scan Barang </label>
                        <div id="reader" class="mx-auto"></div>
                    </div> --}}
                      <div class="form-group">
                        <label>Pilih Ruangan</label>
                        <select class="form-control select2" name="ruangan">
                            @foreach ($lokasi as $item)
                                @if (old('ruangan') == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->nama_lokasi }} </option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->nama_lokasi }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if($errors->has('ruangan'))
                        <div class="invalid-feedback">
                            {{ $errors->first('ruangan') }}
                        </div>
                        @endif
                      </div>
                      <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" value="{{ old('keterangan') }}" class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}">
                        @if($errors->has('keterangan'))
                        <div class="invalid-feedback">
                            {{ $errors->first('keterangan') }}
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

