const mix = require('laravel-mix');

// Compilar archivos JavaScript
mix.js('resources/js/vendor/jquery/jquery.js', 'public/js')
   .js('resources/js/vendor/bootstrap/js/bootstrap.bundle.js', 'public/js')
   .js('resources/js/vendor/jquery-easing/jquery.easing.js','public/js')
   .js('resources/js/sb-admin-2.js','public/js');

// Compilar archivos CSS planos
mix.styles([
    'resources/css/sb-admin-2.css','vendor/fontawesome-free/css/all.css'
], 'public/css/all.css');
