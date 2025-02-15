@extends('layout.app')
@section('title', 'Dashboard')
@section('dashboard-active', 'active')
@section('content')
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Dashboard</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-box"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Barang Belum Terverifikasi</h4>
              </div>
              <div class="card-body">
                {{ $barangterverifikasi }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="fas fa-database "></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Distribusi Baru</h4>
              </div>
              <div class="card-body">
                {{ $distribusibarang }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="fas fa-file-upload"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Peminjaman</h4>
              </div>
              <div class="card-body">
                {{ $peminjaman }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-file-download"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Pengembalian</h4>
              </div>
              <div class="card-body">
                {{ $pengembalian }}
              </div>
            </div>
          </div>
        </div>
      </div>
               <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
              <div class="card">
                <div class="card-header">
                  <h4>Distribusi Barang</h4>
                </div>
                <div class="card-body">
                  <canvas id="grafik"></canvas>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
              <div class="card">
                <div class="card-header">
                  <h4>Distribusi Barang Belum Terverifikasi</h4>
                  @if (auth()->user()->hak_akses == 2)

                  <div class="card-header-action">
                    <a href="{{ url('lihat-verifikasi-distribusi') }}" class="btn btn-primary">Lihat</a>
                  </div>
                  @endif
                </div>
                <div class="card-body">
                  <table class="table table-striped mb-0">
                    <thead>
                      <tr>
                        <th>Barang</th>
                        <th>Penanggung Jawab</th>
                        <th>Ruangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($barang as $b)
                          
                      
                      <tr>
                        <td>
                          @foreach ($b->detailDistribusi as $d)
                          <li>{{ $d->dataBarang->kode_barang }} - {{ $d->dataBarang->dataBarang->nama_barang }} (Merk {{ $d->dataBarang->dataBarang->merk_barang }})</li>
                         @endforeach

                        </td>
                        <td>
                          {{ $b->penanggung_jawab }}
                        </td>
                        <td>
                          {{ $b->dataLokasi->nama_lokasi }}
                        </td>
                       
                      </tr>
                      @endforeach
                      <tr>
                       
                      </tr>
                    </tbody>
                  </table>
                  
                </div>
              </div>
            </div>
          </div>
</section>
</div>
@endsection

@section('cjs')
<script>
   let ctx = document.getElementById("grafik");
    let grafik = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
        datasets: [{
          data: {{ json_encode($chart) }},
          borderWidth: 5,
          backgroundColor: 'transparent',
          borderColor: '#6777ef',
          borderWidth: 3.5,
          pointBackgroundColor: '#ffffff',
          pointBorderColor: '#6777ef',
          pointRadius: 4
        }]
      },
      options: {
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            gridLines: {
              drawBorder: false,
            },
            ticks: {
              beginAtZero: true,
              stepSize: 150
            }
          }],
          xAxes: [{
            ticks: {
              display: false
            },
            gridLines: {
              color: '#fbfbfb',
              lineWidth: 2
            }
          }]
        },
      }
    });
</script>
@endsection

