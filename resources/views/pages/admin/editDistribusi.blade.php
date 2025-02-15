@extends('layout.app')
@section('title', 'Edit Data')
@section('distribusiDataBarang-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Edit Data Distribusi Barang</h1>
    </div>

    <div class="section-body">
        <div class="card" style="width : 70%;">
            <div class="card-body">
                <form method="POST" action="{{ url('edit-distribusi-barang-aksi') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>penanggung_jawab</label>
                        <input type="hidden" name="id" value="{{ $distribusi->id }}">
                        <input type="text" name="penanggung_jawab" value="{{ $distribusi->penanggung_jawab }}" class="form-control {{ $errors->has('penanggung_jawab') ? 'is-invalid' : '' }}">
                        @if($errors->has('penanggung_jawab'))
                        <div class="invalid-feedback">
                            {{ $errors->first('penanggung_jawab') }}
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
                                @foreach($distribusi->detailDistribusi as $d)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $d->dataBarang->kode_barang }}</td>
                                    <td> {{ $d->dataBarang->dataBarang->nama_barang }} (Merk {{ $d->dataBarang->dataBarang->merk_barang }}) Tahun Pembelian {{ $d->dataBarang->dataBarang->tahun_pembelian }}</td>
                                    <td>
                                     <a href="{{ url('hapus-barang-distribusi/'.$d->id) }}" class="btn btn-danger">Hapus</a> 
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
                      <div class="form-group">
                        <label>Pilih Ruangan</label>
                        <select class="form-control select2" name="ruangan">
                            @foreach ($lokasi as $item)
                                @if ($distribusi->ruangan == $item->id)
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
                        <input type="text" name="keterangan" value="{{ $distribusi->keterangan }}" class="form-control {{ $errors->has('keterangan') ? 'is-invalid' : '' }}">
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