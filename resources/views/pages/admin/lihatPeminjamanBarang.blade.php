@extends('layout.app')
@section('title', 'Data Barang')
@section('dataPeminjaman-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Nama Peminjam {{ $data_nama->nama_peminjam }}</h1>
    </div>
    
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                {{-- <a href="{{ url('tambah-unit-barang/'.$data_nama->id) }}" class="btn btn-success"> Tambah Unit Barang</a> --}}
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead>
                      <tr>
                        <th class="text-center">
                          No
                        </th>
                        <th>Nama Peminjam</th>
                        <th>Nama Barang</th>
                        <th>Foto</th>
                         @if (auth()->user()->hak_akses == 1)     
                        @if  ($peminjaman[0]->status == 0) 
                        <th>Aksi</th>
                        @endif

                        @endif 
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $no =1;
                        @endphp
                    @foreach ($peminjaman as $p)
                      <tr>
                        <td>
                          {{ $no++ }}
                        </td>
                        <td>{{ $p->dataPeminjaman->nama_peminjam }}</td>
                        <td>{{ $p->dataBarang->kode_barang }} - {{ $p->dataBarang->dataBarang->nama_barang }} (Merk {{ $p->dataBarang->dataBarang->merk_barang }}) Tahun Pembelian {{ $p->dataBarang->dataBarang->tahun_pembelian }}</td>
                        <td align="center">
                          <img alt="image" src="{{ asset('uploads/'. $p->dataBarang->foto) }}" class="img-responsive" width="50%" data-toggle="tooltip">

                        </td>
                        @if (auth()->user()->hak_akses == 1)  
                        @if ($p->status == 0)  

                        <td><a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modalData_{{ $p->id }}">Pengembalian</a></td>
                        @endif
                        @endif
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>
</div>
<div class="modal fade" id="modalData_17" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="mediumModalLabel">Pengembalian Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">Kondisi Barang</label>

              <div class="col-md-5">
                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email">

                  @if ($errors->has('email'))
                  <div class="invalid-feedback">
                      {{ $errors->first('email') }}
                  </div>
                  @endif
              </div>
          </div>
          <div class="form-group row">
              <label for="username" class="col-md-4 col-form-label text-md-right">Catatan</label>
              <div class="col-md-5">
                  <input id="catatan" type="text" class="form-control{{ $errors->has('catatan') ? ' is-invalid' : '' }}" name="catatan" required>

                  @if ($errors->has('catatan'))
                  <div class="invalid-feedback">
                      {{ $errors->first('catatan') }}
                  </div>
                  @endif
              </div>
          </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
  </div>
</div>
</div>
@endsection


<!-- Modal -->



