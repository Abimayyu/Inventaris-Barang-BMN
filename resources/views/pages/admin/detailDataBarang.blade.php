@extends('layout.app')
@section('title', 'Data Barang')
@section('dataBarang-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Data Barang {{ $data_nama->nama_barang }} (Merk {{ $data_nama->merk_barang }}) Tahun Pembelian {{ $data_nama->tahun_pembelian }}</h1>
    </div>
    
    <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                @if (auth()->user()->hak_akses == 1)
                <a href="{{ url('tambah-unit-barang/'.$data_nama->id) }}" class="btn btn-success"> Tambah Unit Barang</a>
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
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Merk</th>
                        <th>Asal Perolehan</th>
                        <th>Penerima</th>
                        <th>Kondisi</th>
                        <th>Tahun Pembelian</th>
                        <th>Foto</th>
                        @if (auth()->user()->hak_akses == 1)
                        <th>Aksi</th>
                        @endif
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
                        <td>{{ $p->kode_barang }}</td>
                        <td>{{ $p->dataBarang->nama_barang }}</td>
                        <td>{{ $p->dataBarang->merk_barang }}</td>
                        <td>{{ $p->asal_perolehan }}</td>
                        <td>{{ $p->penerima }}</td>
                        <td>
                        
                          <div  class="badge badge-sm badge-{{ $p->kondisi->warna }}">{{ $p->kondisi->kondisi_barang }}</div>
                        </td>
                        <td>{{ $p->dataBarang->tahun_pembelian }}</td>
                        <td align="center">
                          <img alt="image" src="{{ asset('uploads/'. $p->foto) }}" class="img-responsive" width="50%" data-toggle="tooltip">

                        </td>
                        @if (auth()->user()->hak_akses == 1)                      
                        <td>
                            <button class="btn btn-success" onclick="modalQrCode('{{ $p->kode_barang }}')">Generate</button>
                            <a href="{{ url('edit-unit-barang/'.$p->id) }}" class="btn btn-primary">Edit</a> 
                            {{-- <a href="{{ url('hapus-unit-barang/'.$p->id) }}" class="btn btn-danger">Hapus</a> --}}
                            <form action="{{ url('hapus-unit-barang', $p->id) }}" method="POST" class="d-inline">
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

<!-- Modal -->
<div class="modal fade" id="qrCodeModal" tabindex="-1" role="dialog" aria-labelledby="qrCodeLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="qrCodeLabel"> Generate QR Code </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <style>#containerQrCode img{margin: 0 auto}</style>
        <div id="containerQrCode"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <a id="cetakQrCode" href="" target="_blank" class="btn btn-primary">Cetak</a>
      </div>
    </div>
  </div>
</div>

@endsection

@section('cjs')
<script>
  var qrcode = new QRCode("containerQrCode");

  function modalQrCode(id) {
        qrcode.makeCode(id);
        $('#cetakQrCode').attr("href", "{{ url('cetak-qr-code') }}/"+id)
        $('#qrCodeModal').modal('show')
    }

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