@extends('/layout.main')

@section('container')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="page-title mb-0 p-0">Data Anggota</h3>
                <div class="d-flex align-items-center mt-2">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Anggota</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-6 col-4 align-self-center">
            </div>
        </div>
    </div>
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
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#ModalTambah">Tambah Data</button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Anggota</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Get Data -->
                        @foreach ($Users as $u)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $u->no_anggota }}</td>
                            <td>{{ $u->nama }}</td>
                            <td>{{ $u->tgl_lahir }}</td>
                            <td>{{ $u->jk }}</td>
                            <td>{{ $u->level }}</td>
                            <td>
                                <a class="btn btn-success" href="#" data-bs-target="#EditAnggotas{{ $u->id }}"
                                    data-bs-toggle="modal" data-bs-id="{{ $u->id }}"> Edit </a>
                                <form action="{{ url('/data/anggota',$u->id) }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="bg-danger p-2 text-white rounded border-0"
                                        onclick="return confirm('Ingin Menghapus Data?')"> Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="EditAnggotas{{ $u->id }}" tabindex="-1" aria-labelledby="ModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">Edit Data Anggota</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('/data/anggota/update',$u->id) }}" method="post">
                                            @method('get')
                                            @csrf
                                            <div class="form-group mb-3">
                                                <label for="nama">Nama</label>
                                                <input type="text"
                                                    class="form-control @error('nama') is-invalid @enderror" id="nama"
                                                    name="nama" value="{{ old('nama', $u->nama) }}" autofocus required>
                                                @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="tgl_lahir">Tanggal Lahir</label>
                                                <input type="date" data-date="" data-date-format="MMMM DD YYYY"
                                                    class="form-control @error('tgl_lahir') is-invalid @enderror"
                                                    id="tgl_lahir" name="tgl_lahir"
                                                    value="{{ old('tgl_lahir', $u->tgl_lahir) }}">
                                                @error('tgl_lahir')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Jenis Kelamin</label>
                                                <select class="form-control input-sm" name="jk" required>
                                                    @if( $u->jk == 'Perempuan')
                                                    <option value="Perempuan" selected>Perempuan</option>
                                                    <option value="Laki-Laki">Laki-Laki</option>
                                                    @else
                                                    <option value="Perempuan">Perempuan</option>
                                                    <option value="Laki-Laki" selected>Laki-Laki</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="level">Level</label>
                                                <input type="text"
                                                    class="form-control @error('level') is-invalid @enderror" id="level"
                                                    name="level" value="{{ old('level', $u->level) }}" autofocus
                                                    required>
                                                @error('level')
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
                        <!-- Admin 1 -->
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
                                <form style="color: #494e6b;" action="{{ url('/data/anggota') }}" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" autofocus required>
                                        @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                        <input type="date" data-date="" data-date-format="MMMM DD YYYY"
                                            class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir"
                                            name="tgl_lahir" required autofocus>
                                        @error('tgl_lahir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control input-sm" name="jk" required>
                                            <option value="Perempuan">Perempuan</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="level">Level</label>
                                        <input type="text" class="form-control @error('level') is-invalid @enderror"
                                            id="level" name="level" autofocus required>
                                        @error('level')
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
