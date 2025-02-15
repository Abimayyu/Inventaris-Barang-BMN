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
                                <th width="30%" class="bg-light"></th>
                                <td>{{ $data_barang->dataBarang->tahun_pembelian }}</td>
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