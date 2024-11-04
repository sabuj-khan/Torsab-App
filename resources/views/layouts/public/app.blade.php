<!DOCTYPE html>
<html lang="en">

<head>
    <title>TorSab | Here we are sharing knowledge</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="{{ asset('assets/front/css/bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Montserrat:400,700') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Raleway:300,400,500') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Halant:300,400') }}" rel="stylesheet" type="text/css">
    

    
    <script src="{{ asset('assets/front/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/axios.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/config.js') }}"></script>
    <script src="{{ asset('assets/front/js/bootstrap.bundle.js') }}"></script>
    

  </head>

  <body>

   
    @include('layouts.public.navbar')

    
   
   <div>

      @yield('content')


   </div>
    
   

    <!-- Footer-->
    
   
   @include('layouts.public.footer-widgets')

    @include('layouts.public.footer-copyright')


    <!-- end of footer-->
    <script type="text/javascript" src="{{ asset('assets/front/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/bundle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('https://maps.googleapis.com/maps/api/js?v=3.exp') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/main.js') }}"></script>
  </body>


</html>