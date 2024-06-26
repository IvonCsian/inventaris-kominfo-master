<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">Master</li>
          @if (auth()->user()->role != 'anggota')
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-floor-plan"></i>
                <span class="menu-title">Master Data</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link {{ Request::segment(2) == "jenis-kategori" ? "active" : " "  }}" href="{{ route('jenis-kategori.index') }}">Jenis Kategori</a></li>
                    <li class="nav-item"> <a class="nav-link {{ Request::segment(2) == "kategori" ? "active" : " "  }}" href="{{ route('kategori.index') }}">Kategori Kendaraan</a></li>
                    <li class="nav-item"> <a class="nav-link {{ Request::segment(2) == "kendaraan" ? "active" : " "  }}" href="{{ route('kendaraan.index') }}">Data Kendaraan</a></li>
                    <li class="nav-item"> <a class="nav-link {{ Request::segment(2) == 'user' ? 'active' : ''  }}" href="{{ route('user.index') }}">User</a></li>
                </ul>
                </div>
            </li>
          @endif
          @if (auth()->user()->role != 'admin')
          <li class="nav-item {{ Request::segment(1) == "pedoman" ? 'active' : ''  }}">
            <a class="nav-link " href="{{ route('pedoman') }}">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Baca Pedoman</span>
            </a>
          </li>
          <li class="nav-item {{ Request::segment(1) == "laporan" ? 'active' : ''  }}">
            <a class="nav-link " href="{{ route('laporan.create') }}">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Tambah Laporan</span>
            </a>
          </li>
          <li class="nav-item {{ Request::segment(1) == "barang" ? 'active' : ''  }}">
            <a class="nav-link " href="{{ route('barang.index') }}">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Update Kondisi</span>
            </a>
          </li>
          @endif
          @if (auth()->user()->role != 'anggota')
          <li class="nav-item {{ Request::segment(1) == 'log-user' ? 'active' : ''  }}">
            <a class="nav-link" href="{{ route('log.user') }}">
              <i class="menu-icon mdi mdi-account-key"></i>
              <span class="menu-title">Activity User</span>
            </a>
          </li>
          <li class="nav-item {{ Request::segment(1) == 'laporan' ? 'active' : ''  }}">
            <a class="nav-link" href="{{ route('laporan.index') }}">
              <i class="menu-icon mdi mdi-account-key"></i>
              <span class="menu-title">Laporan Anggota</span>
            </a>
          </li>
          @endif
          @if (auth()->user()->role != 'admin')
          <li class="nav-item {{ Request::segment(1) == 'history-barang' ? "active" : ' '  }}">
            <a class="nav-link " href="{{ route('history.barang') }}">
              <i class="menu-icon mdi mdi-history"></i>
              <span class="menu-title">Riwayat Kondisi</span>
            </a>
          </li>
          @endif
          @if (auth()->user()->role != 'anggota')
          <li class="nav-item {{ Request::segment(1) == 'history-kendaraan' ? "active" : ' '  }}">
            <a class="nav-link " href="{{ route('history.kendaraan') }}">
              <i class="menu-icon mdi mdi-history"></i>
              <span class="menu-title">Riwayat Data Kendaraan</span>
            </a>
          </li>
          @endif
        </ul>
      </nav>
