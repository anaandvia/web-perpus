@extends('/layout.main')

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <style>
            a:hover {
                text-decoration: none;
                color: rgba(28, 121, 164, 0.89);
            }

            a {
                text-decoration: none;
                color: black;
            }

            .card:hover {
                box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.192);
                transform: scale(1.02);
            }

        </style>
        @if (auth()->user()->level == 'admin')
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="/data/anggota">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Website</div>
                                <div class="h5 mb-0 font-weight-bold">Data Anggota</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="/data/buku">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Website</div>
                                <div class="h5 mb-0 font-weight-bold">Data Buku</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="/data/peminjaman">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Website</div>
                                <div class="h5 mb-0 font-weight-bold">Data Peminjaman</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @else
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="/data/buku">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Website</div>
                                <div class="h5 mb-0 font-weight-bold">Data Buku</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="/data/peminjaman">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Website</div>
                                <div class="h5 mb-0 font-weight-bold">Data Peminjaman</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endif
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
