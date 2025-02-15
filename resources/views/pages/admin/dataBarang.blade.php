@extends('layout.app')
@section('title', 'Data Barang')
@section('dataBarang-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Data Barang</h1>
    </div>
    
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                @if (auth()->user()->hak_akses == 1)
                <a href="{{ url('daftar-data-barang') }}" class="btn btn-success"> Daftar Data Barang</a>
                @elseif (auth()->user()->hak_akses == 2)
                <a href="{{ url('lihat-verifikasi-barang') }}" class="btn btn-primary"> Verifikasi Barang</a>

                @endif
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead>
                      <tr>
                        <th class="text-center">
                          No
                        </th>
                        <th>Nama Barang</th>
                        <th>Merk</th>
                        <th>Jumlah</th>
                        <th>Tahun Pembelian</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $no =1;
                        @endphp
                    @foreach ($data_barang as $p)
                      <tr>
                        <td>
                          {{ $no++ }}
                        </td>
                        <td>{{ $p->nama_barang }}</td>
                        <td>{{ $p->merk_barang }}</td>
                        <td>{{ count($p->unitVerif) }}</td>
                        <td>{{ $p->tahun_pembelian }}</td>
                      
                        <td>
                          <a href="{{ url('lihat-data-barang/'.$p->id) }}" class="btn btn-success">Lihat</a> 
                          @if (auth()->user()->hak_akses == 1)
                            <a href="{{ url('edit-data-barang/'.$p->id) }}" class="btn btn-primary">Edit</a> 
                            {{-- <a href="{{ url('hapus-data-barang/'.$p->id) }}" class="btn btn-danger">Hapus</a> --}}
                            <form action="{{ url('hapus-data-barang', $p->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('GET')
                              <button type="submit" class="btn btn-danger btn-hapus">Hapus</button>
                          </form>
                          @endif
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
</script>
@endsection