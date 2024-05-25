<style>
    .footer-bottom {
        /*position: fixed; /* Fija el pie de página en la parte inferior de la ventana del navegador */
        bottom: 0; /* Alinea el pie de página en la parte inferior */
        width: 100%; /* Ocupa todo el ancho de la ventana del navegador */ 
        /*background-color: #f0f0f0; /* Ejemplo de color de fondo */
        padding: 10px; /* Agrega relleno para mejorar la legibilidad */
        /*text-align: center; /* Alinea el texto al centro si es necesario */
    }

    .gradient-background {
        width: 100%;
        height: 300px;
        background-image: linear-gradient(to top, #FFFFFF, #6F9292, #5B7F7F, #4C6969, #3C5353); /* Degradado con tonos azules más cercanos al color base */
}
</style>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 4.1.1 -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    <link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/@fortawesome/fontawesome-free/css/all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>

@yield('page_css')
<!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/components.css')}}">
    <style>
      .toolbar {
    float: left;
    }
    .searching{
        float: right;
    }
    </style>
    @yield('page_css')


    @yield('css')
</head>
<body onclick= "playAudio()">
<!-- Musica de fondo -->
<audio id="audio" loop autoplay>
        <source src="{{ asset('audio/fondo_app.mp3') }}" type="audio/mpeg">
        Tu navegador no soporta la reproducción de audio.
</audio>

<div id="app">
    <div  class="main-wrapper main-wrapper-1">
        <div style="background-color: #253745" class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            @include('layouts.header')

        </nav>

        <div style=""  class="main-sidebar main-sidebar-postion; gradient-background">
            @include('layouts.sidebar')
        </div>

        <!-- Main Content -->
        <div style="margin-bottom: 0.05%"class="main-content">
            @yield('content')
        </div>

        <footer style="background-color:black; height:9%;" class="main-footer footer-bottom">
            @include('layouts.footer')
        </footer>

    </div>
</div>
@include('profile.change_password')
@include('profile.edit_profile')

</body>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('web/js/stisla.js') }}"></script>
<script src="{{ asset('web/js/scripts.js') }}"></script>
<script src="{{ mix('assets/js/profile.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
<script src="{{ asset('assets/js/custom/buscador.js') }}"></script>
@yield('page_js')
@yield('scripts')
<script>
    let loggedInUser =@json(\Illuminate\Support\Facades\Auth::user());
    let loginUrl = '{{ route('login') }}';
    // Loading button plugin (removed from BS4)
    (function ($) {
        $.fn.button = function (action) {
            if (action === 'loading' && this.data('loading-text')) {
                this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled', true);
            }
            if (action === 'reset' && this.data('original-text')) {
                this.html(this.data('original-text')).prop('disabled', false);
            }
        };
    }(jQuery));
</script>

<script>
    
    // Manejador de evento para doble clic
    document.body.addEventListener('dblclick', function(event) {
        document.getElementById("audio").pause();  
    });
        
    function playAudio(){
        var audio = document.getElementById("audio");
        audio.volume = 0.25; // Establece el volumen al 50%
        document.getElementById("audio").play();   
    }
</script>
</html>
