<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') | {{ config('app.name') }}</title>

    <!-- General CSS Files -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/components.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>

    </head>
<body onclick= "playAudio()" style="background-color: white; margin: 0; padding: 0; height: 100%;">
<!-- Musica de fondo -->
<audio id="audio" loop autoplay>
        <source src="{{ asset('audio/fondo_login.mp3') }}" type="audio/mpeg">
        Tu navegador no soporta la reproducción de audio.
</audio>

<div id="app">
    <div class="card-header" style="border-color: #FFFFFF;background-color: #253745; color: white; display: flex; justify-content: flex-start; align-items: flex-start; height: 48px;border-radius: 0px;">
                         <div class="login-message" style="margin-top: -20px; color: white; font-size: 20px; font-family: 'Nunito';">Bienvienido</div>
    </div>
    <section class="section" style="padding: 65px">
        <div class="container mt-6" style="">
            <div class="column">
            <div class="row">
                <div class="col-md-6" style="text-align: center;">
                <div class= "login-message" style="margin-bottom: 10px; font-size: 30px; font-family: 'Nunito'">GEO-CODE </div>                         
                <div class="card-header" style="border-color: #9BA8AB; background-color: white; color: black; display: flex height: 45px;">
                    <img clas= "shadow-light rounded" src="{{ asset('img/fondo_login3.gif') }}" alt="logo" width="400"   style="border-radius: 12px;"> 
                    <br>
                    <br>
                </div>
                    <br>
                    <h3 style="margin: 0; font-size: 20px; font-family: 'Courier New'; font-weight: normal; text-transform: none;">API Direcciones - Mexico</h3>
               </div>
                <div class="col-md-6">
                    @yield('content')
                </div>
            </div>
            </div>
        </div>
    </section>
    
    <footer class="card-footer footer-bottom" style="background-color:black; display: flex;
            flex-direction: column; flex:1">
            @include('layouts.footer') 
    </footer>
</div>
<!-- General JS Scripts -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="{{ asset('web/js/stisla.js') }}"></script>
<script src="{{ asset('web/js/scripts.js') }}"></script>
<!-- Page Specific JS File -->

<script>
    
    // Manejador de evento para doble clic
    document.body.addEventListener('dblclick', function(event) {
        document.getElementById("audio").pause();  
    });
        
    function playAudio(){
        document.getElementById("audio").play();   
    }
</script>


</body>
</html>
