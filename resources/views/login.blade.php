{{-- <?php
session_start();

if(isset($_SESSION['level'])){
    header("Location: ../../index.php");
    exit;
}

?> --}}
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/logo-perpus.jpeg">
    <title>{{ $title }} | Perpustakaan Nasional</title>

    <!-- Custom fonts for this template-->

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center mt-5">
            <div class="col-xl-5 col-lg-5 col-md-5">
                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="card o-hidden border-0 shadow-lg my-5" id="card">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="p-5">
                            <div class="card bg-transparent border-0">
                                <a class="brand" href="/">
                                    <img src="/img/logo-perpus.jpeg" width="100%" alt="">
                                </a>
                                <div class="card-body">
                                    <form form method="POST" action="/">
                                        @csrf
                                        <div class="form-group mb-2">
                                            <input name="no_anggota" id="no_anggota" class="form-control form-control-user @error('no_anggota') is-invalid @enderror"
                                                placeholder="No Anggota" autofocus required value="{{ old ('no_anggota') }}">
                                                @error('no_anggota')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                        </div>
                                        <div class="form-group mb-2">
                                            <input name="password" id="password" type="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                placeholder="Password" required>
                                            <span id="mybutton" onclick="change()"><i class="fas fa-eye"></i></span>
                                        </div>
                                        <button type="submit" class="btn btn-user btn-block"
                                            style="background-color: rgba(28, 121, 164, 0.89);color: white;">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        function change() {
            var x = document.getElementById('exampleInputPassword').type;

            if (x == 'password') {
                document.getElementById('exampleInputPassword').type = 'text';
                document.getElementById('mybutton').innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                document.getElementById('exampleInputPassword').type = 'password';
                document.getElementById('mybutton').innerHTML = '<i class="fas fa-eye"></i>';
            }
        }

    </script>
    <style>
        body {
            background-color:  rgba(28, 121, 164, 0.89);
        }

        #card {
            border-radius: 20px;
        }

        .text-center a {
            color: white;
        }

        #mybutton {
            position: relative;
            z-index: 1;
            left: 90%;
            top: -37px;
            cursor: pointer;
            color: grey;
        }

        .form-control:focus,
        .form-group input:hover {
            border-color: #27353B;
            box-shadow: 0 0 0 0.2rem rgba(28, 121, 164, 0.5);
        }

        button .btn:hover {
            background-color: white;
            color: rgba(28, 121, 164, 0.5);
        }

        .brand {
            text-align: center;
        }

    </style>
</body>

</html>
