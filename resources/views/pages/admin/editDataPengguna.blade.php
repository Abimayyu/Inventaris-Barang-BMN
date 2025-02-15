@extends('layout.app')
@section('title', 'Edit Data')
@section('dataPengguna-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Edit Data Pengguna</h1>
    </div>
    <div class="section-body">
        <div class="card" style="width : 70%;">
            <div class="card-body">
                    
                <form method="POST" action="{{ url('editDataPenggunaAksi') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $data_pengguna->id }}" name="id">
                    <input type="hidden" value="{{ $data_pengguna->foto }}" name="old_name_file">
                    <input type="hidden" value="{{ $data_pengguna->username }}" name="old_username">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ $data_pengguna->nama }}" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}">
                        @if($errors->has('nama'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nama') }}
                        </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" value="{{ $data_pengguna->username }}" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}">
                        @if($errors->has('username'))
                        <div class="invalid-feedback">
                            {{ $errors->first('username') }}
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
                       <p>*Hiraukan jika tidak ingin mengganti foto.</p>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
    
                </form>

            </div>
        </div>
    
    </div>  
</section>
</div>
@endsection