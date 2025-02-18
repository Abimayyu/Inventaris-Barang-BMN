@extends('layout.app')
@section('title', 'Qrcode')
@section('dataBarang-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Detail Unit Barang</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header">
                  <h4>Detail Unit Barang {{ $data_barang->kode_barang }}</h4>
                </div>
                <div class="card-body">
                    <div class="container">
                        <table class="table table-bordered">
                                 
                            <tr>
                                <th width="30%" class="bg-light">Kode Barang</th>
                                <td>{{ $data_barang->kode_barang }}</td>
                            </tr>
                            <tr>
                                <th width="30%" class="bg-light">Nama Barang</th>
                                <td>{{ $data_barang->dataBarang->nama_barang }}</td>
                            </tr>
                            <tr>
                                <th width="30%" class="bg-light">Merk Barang</th>
                                <td>{{ $data_barang->dataBarang->merk_barang }}</td>
                            </tr>
                            <tr>
                                <th width="30%" class="bg-light">Asal Perolehan Barang</th>
                                <td>{{ $data_barang->asal_perolehan}}</td>
                            </tr>
                            <tr>
                                <th width="30%" class="bg-light">Tahun Pembelian Barang</th>
                                <td>{{ $data_barang->dataBarang->tahun_pembelian }}</td>
                            </tr>
                            <tr>
                                <th width="30%" class="bg-light">Penerima</th>
                                <td>{{ $data_barang->penerima }}</td>
                            </tr>
                            
                            <tr>
                                <th width="30%" class="bg-light">Status</th>
                                <td>
                                    <div  class="badge badge-sm badge-success">Baik</div>
                                </td>
                            </tr>
                            <tr>
                                <th width="30%" class="bg-light">Foto</th>
                                <td>
                                     <img alt="image" src="{{ asset('uploads/'. $data_barang->foto) }}" class="img-responsive" width="70%" data-toggle="tooltip">
                                </td>
                            </tr>

                            <!-- New fields added below -->
                            @if ($data_barang->kondisi_barang === 4)
                            <tr>
                                <th width="30%" class="bg-light">Distribusi Barang</th>
                                <td>{{ \Carbon\Carbon::parse($data_distribusi->dataDistribusi->tanggal_distribusi)->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                            </tr>
                            <tr>
                                <th width="30%" class="bg-light">Ruangan</th>
                                <td>{{ $data_distribusi->dataDistribusi->ruangan }}</td>
                            </tr>
                            <tr>
                                <th width="30%" class="bg-light">Penanggung Jawab</th>
                                <td>{{ $data_distribusi->dataDistribusi->penanggung_jawab }}</td>
                            </tr>
                            @elseif($data_barang->kondisi_barang === 3)
                            <tr>
                                <th width="30%" class="bg-light">Distribusi Barang</th>
                                <td>
                                    <div  class="badge badge-sm badge-warning">Barang Sedang di Pinjamkan</div>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <th width="30%" class="bg-light">Distribusi Barang</th>
                                <td>
                                    <div  class="badge badge-sm badge-danger">Barang Belum di Distribusikan</div>
                                </td>
                            </tr>
                            @endif
                            

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
