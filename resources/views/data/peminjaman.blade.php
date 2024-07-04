@extends('/layout.main')

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Data Peminjaman</h3>
                <div class="d-flex align-items-center mt-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Peminjaman</li>
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

            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Anggota</th>
                            <th scope="col">Judul Buku</th>
                            <th scope="col">Tanggal Pinjam</th>
                            <th scope="col">Tanggal Kembali</th>
                            <th scope="col">Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Get Data -->
                        @foreach ($Peminjamans as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->users->no_anggota }}</td>
                            <td>{{ $p->buku->judul_buku }}</td>
                            <td>{{ $p->tgl_pinjam }}</td>
                            <td>{{ $p->tgl_kembali }}</td>
                            <td>
                                @if($p->status == 1)
                                <span class="btn btn-success">Buku Di Pinjam</span>
                                @else
                                <span class="btn btn-primary">Buku Di Kembalikan</span>
                                @endif
                            </td>
                            <td>
                                @if(auth()->user()->level == 'admin')
                                <a class="btn btn-success" href="#" data-bs-target="#EditPeminjaman{{ $p->id }}"
                                    data-bs-toggle="modal" data-bs-id="{{ $p->id }}"> Edit </a>
                                <form action="{{ url('/data/peminjaman',$p->id) }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="bg-danger p-2 text-white rounded border-0"
                                        onclick="return confirm('Ingin Menghapus Data?')"> Hapus</button>
                                </form>
                                @else
                                @if($p->status == 1)
                                <span class="btn btn-success">Buku Di Pinjam</span>
                                @else
                                <span class="btn btn-primary">Buku Di Kembalikan</span>
                                @endif
                                @endif
                            </td>
                        </tr>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="EditPeminjaman{{ $p->id }}" tabindex="-1"
                            aria-labelledby="ModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">Edit Status Peminjaman</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('/data/peminjaman',$p->id) }}" method="post">
                                            @method('put')
                                            @csrf
                                            <div class="form-group mb-3">
                                                <label for="no_anggota">No Anggota</label>
                                                <input type="text"
                                                    class="form-control @error('no_anggota') is-invalid @enderror"
                                                    id="no_anggota" name="no_anggota"
                                                    value="{{ old('no_anggota', $p->users->no_anggota) }}" readonly>
                                                @error('judul_buku')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="judul_buku">Judul Buku</label>
                                                <input type="text"
                                                    class="form-control @error('judul_buku') is-invalid @enderror"
                                                    id="judul_buku" name="judul_buku"
                                                    value="{{ old('judul_buku', $p->buku->judul_buku) }}" readonly>
                                                @error('judul_buku')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                <input type="hidden" class="form-control" id="buku_id" name="buku_id"
                                                    value="{{ old('buku_id', $p->buku->id) }}">
                                                <input type="hidden" class="form-control" id="stok" name="stok"
                                                    value="{{ old('stok', ($p->buku->stok + 1)) }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Status</label>
                                                <select class="form-control input-sm" name="status" required>
                                                    @if( $p->status == '1')
                                                    <option value="1" selected>Buku Di Pinjam</option>
                                                    <option value="2">Buku Di Kembalikan</option>
                                                    @else
                                                    <option value="1">Buku Di Pinjam</option>
                                                    <option value="2" selected>Buku Di Kembalikan</option>
                                                    @endif
                                                </select>
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
                        <!-- Admin 1 -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // Tables
        $('#dataTable').DataTable();

    </script>
    @endsection
