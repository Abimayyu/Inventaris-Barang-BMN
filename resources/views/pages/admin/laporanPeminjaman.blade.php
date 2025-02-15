<!DOCTYPE html>
<html>
<head>
	<title>CETAK Laporan Peminjaman Barang</title>
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
	
    <style>
        h1, h2, h5, p, table {
            color: black;
            font-family:'Times New Roman';
            text-align: center;
        }
        .table td, .table th {
            color: black;
            border: 1px solid black;
        }
        table, tr, th, td {
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-2">
                <img src="{{ asset('assets/img/tutwuri.png') }}" width="150px" height="180px" style="float: left" >
            </div>
            <div class="col-md-9">
                <h2>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h2>
                <h3 style="text-align: center">BALAI PENJAMINAN MUTU PENDIDIKAN PROVINSI BENGKULU</h3>
                <p>Jalan Zainul Arifin Nomor 2 Lingkar Timur, Bengkulu 38229<br>
                Telepon 0736-28987, Laman lpmpbengkulu.kemdikbud.go.id</p>
            </div>
			<div class="col-md-1"></div>
        </div>
        <br>
        <hr style="border:3px solid #000">
        <h5 class="text-center font-weight-bold">Daftar Peminjaman Barang</h5>
        <p class="text-center">Laporan Peminjaman dari tanggal 
        <?php 
        $newDate3 = date("d-M-Y", strtotime($tglawal));  
        echo $newDate3;
        ?> sampai dengan tanggal 
        <?php 
        $newDate3 = date("d-M-Y", strtotime($tglakhir));  
        echo $newDate3;
        ?></p>
        <div class="row">
            <table class="table table-bordered text-dark" width="100%">
                <tr align="center">
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Barang</th>
                    <th>Tanggal Pengembalian</th>
                    
                </tr>
                @php
                    $no =1;
                @endphp
                @foreach ($peminjaman as $p)
                <tr align="center">
                    <td>
                        {{ $no++ }}
                      </td>
                      <td>{{ $p->nama_peminjam }}</td>
                      <td>{{ $p->tgl_peminjaman }}</td>
                      <td>
                        <ul>
                            @foreach ($p->detailPeminjaman as $d)
                            <li>{{ $d->dataBarang->kode_barang }} - {{ $d->dataBarang->dataBarang->nama_barang }} (Merk {{ $d->dataBarang->dataBarang->merk_barang }}) Tahun Pembelian {{ $d->dataBarang->dataBarang->tahun_pembelian }}</li>
                            @endforeach
                        </ul>
                      </td>
                      <td>{{ $p->tgl_pengembalian }}</td>

                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
    <script>
		window.print();
	</script>
</html>