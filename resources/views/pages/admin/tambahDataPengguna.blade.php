@extends('layout.app')
@section('title', 'Tambah Data')
@section('dataPengguna-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Tambah Data Pengguna</h1>
    </div>

    <div class="section-body">
        <div class="card" style="width : 70%;">
            <div class="card-body">
                <form method="POST" action="{{ url('tambahDataPenggunaAksi') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}">
                        @if($errors->has('nama'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nama') }}
                        </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}">
                        @if($errors->has('username'))
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                        @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Hak Akses</label>
                        <select  name="hak_akses" class="form-control {{ $errors->has('hak_akses') ? 'is-invalid' : '' }}">
                            <option value="">-- Pilih Status --</option>
                            <option value="1" @if (old('status') == 1) selected @endif>Pengelola</option>
                            <option value="2" @if (old('status') == 2) selected @endif>Verifikator</option>
                        </select>
                        @if($errors->has('hak_akses'))
                        <div class="invalid-feedback">
                            {{ $errors->first('hak_akses') }}
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