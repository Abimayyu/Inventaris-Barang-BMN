@extends('layout.app')
@section('title', 'Data Pengguna')
@section('dataPengguna-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Data Pengguna</h1>
    </div>
    
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="{{ url('tambahDataPengguna') }}" class="btn btn-success"> Tambah Data Pengguna</a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead>
                      <tr>
                        <th class="text-center">
                          No
                        </th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $no =1;
                        @endphp
                    @foreach ($data_pengguna as $p)
                      <tr>
                        <td>
                          {{ $no++ }}
                        </td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->username }}</td>
                        <td>
                          <img alt="image" src="{{ asset('assets/img/avatar/'. $p->foto) }}" class="rounded-circle" width="35" data-toggle="tooltip">
                        </td>
                        <td>
                            <a href="{{ url('editDataPengguna/'.$p->id) }}" class="btn btn-primary">Edit</a> 
                            {{-- <a href="{{ url('hapusDataPengguna/'.$p->id) }}" class="btn btn-danger">Hapus</a> --}}
                            <form action="{{ url('resetPasswordDataPengguna', $p->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('GET')
                              <button type="submit" class="btn btn-warning btn-reset    "><i class="fas fa-key"></i></button>
                          </form>
                            <form action="{{ url('hapusDataPengguna', $p->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('GET')
                              <button type="submit" class="btn btn-danger btn-hapus    ">Hapus</button>
                          </form>
                          </td>
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
@endsection
@section('cjs')
<script>
  $('.btn-hapus').on('click', function (e) {
            e.preventDefault(); // prevent form submit
            var form = event.target.form;
            Swal.fire({
            title: 'Yakin Menghapus Data?',
            text: "Data Akan Terhapus Permanen",
            icon: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        $('.btn-reset').on('click', function (e) {
            e.preventDefault(); // prevent form submit
            var form = event.target.form;
            Swal.fire({
            title: 'Mereset Password?',
            text: "Password Akan Sesuai dengan Username",
            icon: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Reset',
            cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
</script>

@endsection