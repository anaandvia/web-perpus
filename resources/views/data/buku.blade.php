@extends('/layout.main')

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Data Buku</h3>
                <div class="d-flex align-items-center mt-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Buku</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-6 col-4 align-self-center">
            </div>
        </div>
    </div>

    {{-- Alert --}}
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session()->has('failed'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('failed') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    {{-- Alert --}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                @if (auth()->user()->level == 'admin')
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#ModalTambah">Tambah Data</button>
                @else
                <div></div>
                @endif
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul Buku</th>
                            <th scope="col">Jumlah Halaman</th>
                            <th scope="col">Tanggal Terbit</th>
                            <th scope="col">Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Get Data -->
                        @foreach ($Bukus as $b)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $b->judul_buku }}</td>
                            <td>{{ $b->n_hal }}</td>
                            <td>{{ $b->tgl_terbit }}</td>
                            <td>{{ $b->stok }}</td>
                            <td>
                                @if(auth()->user()->level == 'admin')
                                <a class="btn btn-success" href="#" data-bs-target="#EditBukus{{ $b->id }}"
                                    data-bs-toggle="modal" data-bs-id="{{ $b->id }}"> Edit </a>
                                <form action="{{ url('/data/buku',$b->id) }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="bg-danger p-2 text-white rounded border-0"
                                        onclick="return confirm('Ingin Menghapus Data?')"> Hapus</button>
                                </form>
                                @else
                                <a class="btn btn-success" href="#" data-bs-target="#PinjamBukus{{ $b->id }}"
                                    data-bs-toggle="modal" data-bs-id="{{ $b->id }}">Pinjam</a>
                                @endif
                                <!-- Modal Pinjam -->
                                <div class="modal fade" id="PinjamBukus{{ $b->id }}" tabindex="-1"
                                    aria-labelledby="ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalLabel">Pinjam Buku</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('/data/peminjaman/baru',$b->id) }}" method="post">
                                                    @method('get')
                                                    @csrf
                                                    <div class="form-group mb-3">
                                                        <label for="judul_buku">Judul Buku</label>
                                                        <input type="text" class="form-control" id="judul_buku"
                                                            name="judul_buku"
                                                            value="{{ old('judul_buku', $b->judul_buku) }}" readonly>
                                                        <input type="hidden" class="form-control" id="stok" name="stok"
                                                            value="{{ old('stok', $b->stok - 1) }}" readonly>
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="tgl_pinjam">Tanggal Pinjam</label>
                                                        <input type="date" data-date="" data-date-format="MMMM DD YYYY"
                                                            class="form-control @error('tgl_pinjam') is-invalid @enderror"
                                                            id="tgl_pinjam" name="tgl_pinjam">
                                                        @error('tgl_pinjam')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="tgl_kembali">Tanggal Kembali</label>
                                                        <input type="date" data-date="" data-date-format="MMMM DD YYYY"
                                                            class="form-control @error('tgl_kembali') is-invalid @enderror"
                                                            id="tgl_kembali" name="tgl_kembali">
                                                        @error('tgl_kembali')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">PINJAM</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Modal Pinjam -->
                            </td>
                        </tr>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="EditBukus{{ $b->id }}" tabindex="-1" aria-labelledby="ModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">Edit Data Buku</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('/data/buku',$b->id) }}" method="post">
                                            @method('put')
                                            @csrf
                                            <div class="form-group mb-3">
                                                <label for="judul_buku">Judul Buku</label>
                                                <input type="text"
                                                    class="form-control @error('judul_buku') is-invalid @enderror"
                                                    id="judul_buku" name="judul_buku"
                                                    value="{{ old('judul_buku', $b->judul_buku) }}" autofocus required>
                                                @error('judul_buku')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="n_hal">Jumlah Halaman</label>
                                                <input type="number"
                                                    class="form-control @error('n_hal') is-invalid @enderror" id="n_hal"
                                                    name="n_hal" value="{{ old('n_hal', $b->n_hal) }}" autofocus
                                                    required>
                                                @error('n_hal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="tgl_terbit">Tanggal Terbit</label>
                                                <input type="date" data-date="" data-date-format="MMMM DD YYYY"
                                                    class="form-control @error('tgl_terbit') is-invalid @enderror"
                                                    id="tgl_terbit" name="tgl_terbit"
                                                    value="{{ old('tgl_terbit', $b->tgl_terbit) }}">
                                                @error('tgl_terbit')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="stok">Stok</label>
                                                <input type="number"
                                                    class="form-control @error('stok') is-invalid @enderror" id="stok"
                                                    name="stok" value="{{ old('stok', $b->stok) }}" autofocus required>
                                                @error('stok')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Modal Edit -->
                        @endforeach
                    </tbody>
                </table>
                <!-- Modal Tambah -->
                <div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalLabel">Tambah Data Anggota</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form style="color: #494e6b;" action="{{ url('/data/buku') }}" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="judul_buku">Judul Buku</label>
                                        <input type="text"
                                            class="form-control @error('judul_buku') is-invalid @enderror"
                                            id="judul_buku" name="judul_buku" autofocus required>
                                        @error('judul_buku')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="n_hal">Jumlah Halaman</label>
                                        <input type="number" class="form-control @error('n_hal') is-invalid @enderror"
                                            id="n_hal" name="n_hal" autofocus required>
                                        @error('n_hal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tgl_terbit">Tanggal Terbit</label>
                                        <input type="date" data-date="" data-date-format="MMMM DD YYYY"
                                            class="form-control @error('tgl_terbit') is-invalid @enderror"
                                            id="tgl_terbit" name="tgl_terbit">
                                        @error('tgl_terbit')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="stok">Stok</label>
                                        <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                            id="stok" name="stok" autofocus required>
                                        @error('stok')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <button class="btn btn-primary" type="submit">Simpan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ModalTambah --}}
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // Tables
        $('#dataTable').DataTable();

    </script>
    @endsection
