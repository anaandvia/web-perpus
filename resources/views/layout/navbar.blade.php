<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">{{ auth()->user()->nama }}</a>
                <button class="navbar-toggler bg-white" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Perpustakaan Nasional</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/dashboard">Dashboard</a>
                            </li>
                            <li class="nav-item dropdown mb-3">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Perpustakaan
                                </a>
                                <ul class="dropdown-menu">
                                    @if (auth()->user()->level == 'admin')
                                    <li><a class="dropdown-item" href="/data/anggota">Data Anggota</a></li>
                                    <li><a class="dropdown-item" href="/data/buku">Data Buku</a></li>
                                    <li><a class="dropdown-item" href="/data/peminjaman">Data Peminjaman</a></li>
                                    @else
                                    <li><a class="dropdown-item" href="/data/buku">Data Buku</a></li>
                                    <li><a class="dropdown-item" href="/data/peminjaman">Data Peminjaman</a></li>
                                    @endif
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- End of Topbar -->

        <!-- Modal -->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Tekan "Logout" untuk keluar dari sesi saat ini
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="btn btn-primary" type="submit">Logout</button></form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal --}}
