@extends('layout.app')
@section('title', 'Data Barang')
@section('distribusiDataBarang-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Verifikasi Distribusi Barang</h1>
    </div>
    
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
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
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $no =1;
                        @endphp
                    @foreach ($barang as $p)
                      <tr>
                        <td>
                          {{ $no++ }}
                        </td>
    
                         
                        <td>{{ $p->tanggal_distribusi }}</td>
                        <td>
                          <ul>
                            @foreach ($p->detailDistribusi as $d)
                             <li>{{ $d->dataBarang->kode_barang }} - {{ $d->dataBarang->dataBarang->nama_barang }} (Merk {{ $d->dataBarang->dataBarang->merk_barang }}) Tahun Pembelian {{ $d->dataBarang->dataBarang->tahun_pembelian }}</li>
                            @endforeach
                          </ul>
                        </td>
                        <td>{{ $p->penanggung_jawab }}</td>
                        <td>{{ $p->dataLokasi->nama_lokasi }}</td>
                        <td>{{ $p->keterangan }}</td>
                          <td>
                            <a href="{{ url('verifikasi-distribusi/'.$p->id) }}" class="btn btn-primary">Verifikasi</a> 
                            <form action="{{ url('hapus-distribusi', $p->id) }}" method="POST" class="d-inline">
                              @csrf
                              @method('GET')
                              <button type="submit" class="btn btn-danger btn-hapus">Tolak</button>
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
            title: 'Tolak Distribusi Data?',
            text: "Data yang Ditolak Terhapus Permanen",
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