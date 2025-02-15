@extends('layout.app')
@section('title', 'Data Barang')
@section('distribusiDataBarang-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Distribusi Barang</h1>
    </div>
    
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              @if (auth()->user()->hak_akses == 1)
                <a href="{{ url('tambah-distribusi') }}" class="btn btn-success"> Tambah Distribusi Barang</a>
              @elseif (auth()->user()->hak_akses == 2)
                <a href="{{ url('lihat-verifikasi-distribusi') }}" class="btn btn-success"> Verifikasi Distribusi Barang</a>
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
                        <th>Tanggal Distribusi</th>
                        <th>Barang</th>
                        <th>Penanggung Jawab Barang</th>
                        <th>Ruangan/ Lokasi/ Bagian </th>
                        <th>Keterangan </th>
                         @if (auth()->user()->hak_akses == 1)
                        <th>Aksi</th>
                        @endif
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
    
                         
                        <td>{{ $p->tanggal_distribusi }}</td>
                        <td>
                          <ul>
                            @foreach ($p->detailDistribusi as $d)
                              <li>
                                @if($d->dataBarang)
                                  {{ $d->dataBarang->kode_barang }} - 
                                  {{ $d->dataBarang->dataBarang->nama_barang ?? 'Nama barang tidak tersedia' }} 
                                  (Merk {{ $d->dataBarang->dataBarang->merk_barang ?? 'Merk tidak tersedia' }}) 
                                  Tahun Pembelian {{ $d->dataBarang->dataBarang->tahun_pembelian ?? 'Tahun tidak tersedia' }}
                                @else
                                  <span>Data barang tidak tersedia</span>
                                @endif
                              </li>
                            @endforeach
                          </ul>
                        </td>
                        <td>{{ $p->penanggung_jawab }}</td>
                        <td>{{ $p->dataLokasi->nama_lokasi }}</td>
                        <td>{{ $p->keterangan }}</td>
                        @if (auth()->user()->hak_akses == 1)
                          <td>
                            <a href="{{ url('edit-distribusi-barang/'.$p->id) }}" class="btn btn-primary">Edit</a> 
                            {{-- <a href="{{ url('hapus-data-barang/'.$p->id) }}" class="btn btn-danger">Hapus</a> --}}
                            <form action="{{ url('hapus-distribusi', $p->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('GET')
                              <button type="submit" class="btn btn-danger btn-hapus">Hapus</button>
                            </form>
                          </td>
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