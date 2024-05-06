<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form id="formRegistro">
        <h3>Login Here</h3>

        <label for="Nombre">Nombre</label>
        <input type="text" id="nombre">

        <label for="apellido1">Primer Apellido</label>
        <input type="text" id="primerApellido">

        <label for="apellido2">Segundo Apellido</label>
        <input type="text" id="segundoApellido">

        <label for="usuario">Username</label>
        <input type="text" id="username">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password">

        <button type="submit">Registrarse</button>
    </form>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#formulario').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize(); // Obtener los datos del formulario

            $.ajax({
                url: "{{ route('ruta.de.tu.api') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    console.log(response); // Manejar la respuesta de la API
                    window.location.href = 'index.php'; // Redirigir a la página index.php
                },
                error: function(xhr, status, error) {
                    console.error(error); // Manejar los errores
                }
            });
        });
    });
    </script>
</html>
