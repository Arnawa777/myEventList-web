<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     {{-- ambil title dari controller --}}
     <title>{{ $title }}</title>
    {{-- Ajax CDN --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
      {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
      <link rel="stylesheet" href="{{asset('../css/bootstrap.min.css')}}">
      
      {{-- Bootstrap Icon --}}
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
      {{-- Trix Text Editor --}}
      <link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/trix.css">
      <script type="text/javascript" src="{{ URL::to('/') }}/js/trix.js"></script>
      {{-- Trix Hide Upload --}}
      <style> 
      trix-toolbar [data-trix-button-group="file-tools"]{
        display:none;
      }
      </style>
      
      {{-- https://select2.org/ harus dibawah Ajax CDN--}}
      <link rel="stylesheet" href="{{ URL::to('/') }}/css/select2.css" />
      <script src="{{ URL::to('/') }}/js/select2.js"></script>

      <link rel="stylesheet" href="{{ URL::to('/') }}/css/style.css">
      <link rel="stylesheet" href="{{ URL::to('/') }}/css/dashboard.css">
    </head>

  <body>
    @include('dashboard.layouts.header')
    
    <div class="container-fluid">
      <div class="row">
        @include('dashboard.layouts.sidebars')
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          @yield('container')
        </main>
      </div>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
    {{-- <script src="../js/bootstrap.js"></script> --}}
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076c9a6eb.js" crossorigin="anonymous"></script>
    

    <script src="{{ URL::to('/') }}/js/dashboard.js"></script>
    
    
  </body>


</html>
