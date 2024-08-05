<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Sistema Campinia II</title>

    <!-- Custom fonts for this template-->
    <link href="{{mix('/resources/js/vendor/fontawesome-free/css/all.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{mix('/resources/css/sb-admin-2.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center my-5">

            <div class="col-xl-10 col-lg-12 col-md-9 my-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenido de nuevo!</h1>
                                    </div>
                                    <form class="user" action="{{route('login.usuario')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input class="form-control form-control-user"
                                                name="username" aria-describedby="emailHelp"
                                                placeholder="Ingresa tu nombre de usuario">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="contrasenia" placeholder="Ingrese su contraseña">
                                        </div>
                                        <button class="btn btn-ingreso btn-user btn-block" type="submit">
                                            Ingreso
                                        </button>
                                        <hr>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Olvidaste tu contraseña?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{route('registro.usuario')}}">Create una cuenta!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{mix('resources/js/vendor/jquery/jquery.js')}}"></script>
    <script src="{{mix('resources/js/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{mix('resources/js/vendor/jquery-easing/jquery.easing.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{mix('resources/js/sb-admin-2.js')}}"></script>

</body>

</html>