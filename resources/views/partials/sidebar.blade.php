<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('home') }}">SIM Perpus</a>
            <p class="mt-0">
                <small>SDN 001 Muara Bengal</small>
            </p>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('home') }}">SIM-P</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header" style="color: #A23E48; font-weight: bold;">Dashboard</li>
            <li class="nav-item dropdown">
                <a href="{{ url('home') }}" class="nav-link">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if(Auth::user()->hasRole('Admin'))
                <li class="menu-header"style="color: #A23E48; font-weight: bold;">Master Data</li>
                <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('users/') }}">
                        <i class="fas fa-user"></i>
                        <span>Pengguna</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('students*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('students/') }}">
                        <i class="fas fa-user-friends"></i>
                        <span>Siswa</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('books*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('books/') }}">
                        <i class="fas fa-book"></i>
                        <span>Buku</span>
                    </a>
                </li>
                <li class="menu-header" style="color: #A23E48; font-weight: bold;">Transaksi</li>
                <li class="nav-item {{ Request::is('transactions*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('transactions/') }}">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Pinjam & Kembali</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('transactions/denda*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('transactions/denda') }}">
                        <i class="fas fa-file-alt"></i>
                        <span>Denda</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blank.html">
                        <i class="fas fa-file"></i>
                        <span>Laporan</span>
                    </a>
                </li>
            @elseif (Auth::user()->hasRole('Pengguna'))
                <li class="menu-header" style="color: #A23E48; font-weight: bold;">Transaksi</li>
                <li class="nav-item {{ Request::is('user-transactions/create*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('user-transactions/create') }}">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Pinjam Buku</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('user-transactions/list*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('user-transactions/list') }}">
                        <i class="fas fa-exchange-alt"></i>
                        <span>List Peminjaman</span>
                    </a>
                </li>
            @elseif (Auth::user()->hasRole('Kepala Sekolah'))
                <li class="menu-header" style="color: #A23E48; font-weight: bold;">Laporan</li>
                <li class="nav-item {{ Request::is('staff-report*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('transactions/') }}">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Pinjam Buku</span>
                    </a>
                </li>
            @endif
        </ul>
        <div class="dropdown-divider"></div>
        <div class="mt-2 mb-4 p-3 hide-sidebar-mini">
            <a
                href="{{ route ('logout') }}"
                class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </div>
    </aside>
</div>
