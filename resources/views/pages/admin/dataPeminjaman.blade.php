@extends('layout.app')
@section('title', 'Data Barang')
@section('dataPeminjaman-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Peminjaman Barang</h1>
    </div>
    
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                @if (auth()->user()->hak_akses == 1)
                <a href="{{ url('tambah-peminjaman-barang') }}" class="btn btn-success">Tambah Peminjaman Barang</a>
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
                        <th>Nama Peminjam</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Aksi</th>
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
                        <td>{{ $p->nama_peminjam }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tgl_peminjaman)->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                        @if ($p->tgl_pengembalian == NULL)
                        <td>Belum Dikembalikan</td>
                        @else
                        <td>{{ \Carbon\Carbon::parse($p->tgl_pengembalian)->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                        @endif
                      
                        <td>
                          <a href="{{ url('lihat-detail-peminjaman/'.$p->id) }}" class="btn btn-success">Lihat</a> 
                      @if (auth()->user()->hak_akses == 1)

                          @if ($p->tgl_pengembalian == NULL)
                          <a href="{{ url('kembalikan-barang/'.$p->id) }}" class="btn btn-warning">Pengembalian</a>
                          @endif
                          @if ($p->tgl_pengembalian == NULL)
                            <a href="{{ url('edit-peminjaman-barang/'.$p->id) }}" class="btn btn-primary">Edit</a> 
                          @endif
                            {{-- <a href="{{ url('hapus-data-barang/'.$p->id) }}" class="btn btn-danger">Hapus</a> --}}
                            <form action="{{ url('hapus-peminjaman-barang', $p->id) }}" method="POST" class="d-inline">
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