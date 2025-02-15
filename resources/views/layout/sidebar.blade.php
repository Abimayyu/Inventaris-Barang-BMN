<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Inventaris Barcode</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">IB</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Main Menu</li>
          <li class="@yield('dashboard-active')"><a class="nav-link" href="{{ url('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
          @if (auth()->user()->hak_akses == 1)
          <li class="@yield('dataPengguna-active')"><a class="nav-link" href="{{ url('dataPengguna') }}"><i class="fas fa-user"></i> <span>Data Pengguna</span></a></li>
          @endif
          <li class="menu-header">Manajemen Barang</li>
          <li class="@yield('dataBarang-active')"><a class="nav-link" href="{{ url('dataBarang') }}"><i class="fas fa-box-open"></i></i> <span>Data Barang</span></a></li>
          <li class="@yield('distribusiDataBarang-active')"><a class="nav-link" href="{{ url('distribusiDataBarang') }}"><i class="fas fa-database"></i> <span>Distribusi Data Barang</span></a></li>
          {{-- <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i> <span>Manajemen Barang</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ url('dataBarangMasuk') }}">Barang Masuk</a></li>
              <li><a class="nav-link" href="{{ url('dataBarangKeluar') }}">Barang Keluar</a></li>
            </ul>
          </li> --}}
          
          @if (auth()->user()->hak_akses == 1)
          <li class="@yield('ambilQrcode-active')"><a class="nav-link" href="{{ url('ambilQrcode') }}"><i class="fas fa-qrcode"></i> <span>Qr Code</span></a></li>
          @endif

          
          <li class="@yield('dataPeminjaman-active')"><a class="nav-link" href="{{ url('dataPeminjaman') }}"><i class="fas fa-file-upload"></i><span>Peminjaman Barang</span></a></li>
          <li class="@yield('laporan-active')"><a class="nav-link" href="{{ url('laporan') }}"><i class="fas fa-file"></i> <span>Laporan</span></a></li>



        </ul>

    </aside>
  </div>