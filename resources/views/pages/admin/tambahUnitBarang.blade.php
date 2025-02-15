@extends('layout.app')
@section('title', 'Tambah Data')
@section('dataBarang-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Tambah Unit Data Barang</h1>
    </div>


    <div class="section-body">
        <div class="card" style="width : 70%;">
            <div class="card-body">
                <form method="POST" action="{{ url('tambah-unit-barang-aksi') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_data_barang" value="{{ $data_barang->id }}">
                    {{-- <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" id="inputKodeBarang" placeholder="_.__.__.__.___.___" name="kode_barang" value="{{ old('kode_barang') }}" class="form-control {{ $errors->has('kode_barang') ? 'is-invalid' : '' }}" >
                        @if($errors->has('kode_barang'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kode_barang') }}
                        </div>
                        @endif
                    </div> --}}
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" value="{{ $data_barang->nama_barang }}" class="form-control {{ $errors->has('nama_barang') ? 'is-invalid' : '' }}" readonly>
                        @if($errors->has('nama_barang'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nama_barang') }}
                        </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label>Merk Barang</label>
                        <input type="text" name="merk_barang" value="{{ $data_barang->merk_barang }}" class="form-control {{ $errors->has('merk_barang') ? 'is-invalid' : '' }}" readonly>
                        @if($errors->has('merk_barang'))
                        <div class="invalid-feedback">
                            {{ $errors->first('merk_barang') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Asal Perolehan</label>
                        <select  name="asal_perolehan" class="form-control {{ $errors->has('asal_perolehan') ? 'is-invalid' : '' }}">
                            <option>-- Asal Perolehan --</option>
                                    <option value="Pembelian">Pembelian</option>
                                    <option value="Transfer Masuk">Transfer Masuk</option>
                                    <option value="Hibah">Hibah</option>
                        </select>
                        @if($errors->has('asal_perolehan'))
                        <div class="invalid-feedback">
                            {{ $errors->first('asal_perolehan') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Penerima</label>
                        <input type="text" name="penerima" value="{{ $data_barang->penerima }}" class="form-control {{ $errors->has('penerima') ? 'is-invalid' : '' }}">
                        @if($errors->has('penerima'))
                        <div class="invalid-feedback">
                            {{ $errors->first('penerima') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Kondisi</label>
                        <select  name="kondisi" class="form-control {{ $errors->has('kondisi') ? 'is-invalid' : '' }}">
                            <option>-- Kondisi Barang --</option>
                                    <option value="1">Baik</option>
                                    <option value="2">Rusak</option>
                        </select>
                        @if($errors->has('kondisi'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kondisi') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Tahun Pembelian</label>
                        <input type="number" name="tahun_pembelian"  value="{{ $data_barang->tahun_pembelian }}"   class="form-control {{ $errors->has('tahun_pembelian') ? 'is-invalid' : '' }}" readonly>
                        @if($errors->has('tahun_pembelian'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tahun_pembelian') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" name="foto" class="form-control {{ $errors->has('foto') ? 'is-invalid' : '' }}">
                        @if($errors->has('foto'))
                          <div class="invalid-feedback">
                            {{ $errors->first('foto') }}
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

@section('cjs')
<script>
    $("#inputKodeBarang").inputmask({"mask": "9.99.99.99.999.999"});
</script>
@endsection