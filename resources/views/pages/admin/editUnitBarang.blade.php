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
                <form method="POST" action="{{ url('edit-unit-barang-aksi') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data_barang->id }}">
                    <input type="hidden" name="id_data_barang" value="{{ $data_barang->id_data_barang }}">
                    <input type="hidden" value="{{ $data_barang->kode_barang }}" name="old_kode_barang">
                    <input type="hidden" value="{{ $data_barang->foto }}" name="old_name_file">

                    <div class="form-group">
                        <label>Kode Barang</label>
                        <input type="text" id="inputKodeBarang" placeholder="_.__.__.__.___.___" name="kode_barang" value="{{ $data_barang->kode_barang }}" class="form-control {{ $errors->has('kode_barang') ? 'is-invalid' : '' }}" >
                        @if($errors->has('kode_barang'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kode_barang') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" value="{{ $data_barang->dataBarang->nama_barang }}" class="form-control {{ $errors->has('nama_barang') ? 'is-invalid' : '' }}" readonly>
                        @if($errors->has('nama_barang'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nama_barang') }}
                        </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label>Merk Barang</label>
                        <input type="text" name="merk_barang" value="{{ $data_barang->dataBarang->merk_barang }}" class="form-control {{ $errors->has('merk_barang') ? 'is-invalid' : '' }}" readonly>
                        @if($errors->has('merk_barang'))
                        <div class="invalid-feedback">
                            {{ $errors->first('merk_barang') }}
                        </div>
                        @endif
                    </div>
                    {{-- <div class="form-group">
                        <label>Lokasi</label>
                        <select  name="lokasi" class="form-control {{ $errors->has('lokasi') ? 'is-invalid' : '' }}">
                            <option>-- Pilih Lokasi --</option>
                            @foreach ($lokasi as $item)
                                @if ($data_barang->lokasi == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->nama_lokasi }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->nama_lokasi }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if($errors->has('lokasi'))
                        <div class="invalid-feedback">
                            {{ $errors->first('lokasi') }}
                        </div>
                        @endif
                    </div> --}}
                    <div class="form-group">
                        <label>Asal Perolehan</label>
                        <select name="asal_perolehan" class="form-control {{ $errors->has('asal_perolehan') ? 'is-invalid' : '' }}">
                            <option value="">-- Asal Perolehan --</option>
                            <option value="Pembelian" {{ old('asal_perolehan', $data_barang->asal_perolehan) == 'Pembelian' ? 'selected' : '' }}>Pembelian</option>
                            <option value="Transfer Masuk" {{ old('asal_perolehan', $data_barang->asal_perolehan) == 'Transfer Masuk' ? 'selected' : '' }}>Transfer Masuk</option>
                            <option value="Hibah" {{ old('asal_perolehan', $data_barang->asal_perolehan) == 'Hibah' ? 'selected' : '' }}>Hibah</option>
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
                        <label>Tahun Pembelian</label>
                        <input type="number" name="tahun_pembelian"  value="{{ $data_barang->dataBarang->tahun_pembelian }}"   class="form-control {{ $errors->has('tahun_pembelian') ? 'is-invalid' : '' }}" readonly>
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
