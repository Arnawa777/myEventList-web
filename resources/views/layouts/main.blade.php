<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- CRSF TOKEN -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
     {{-- ambil title dari controller --}}
     <title>{{ $title }}</title>
	{{-- Ajax CDN --}}
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

	{{-- Bootstrap Icon --}}
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

	{{-- Trix Text Editor --}}
	<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/trix.css">
	<script type="text/javascript" src="{{ URL::to('/') }}/js/trix.js"></script>
	<script src="{{ URL::to('/') }}/js/dashboard.js"></script>

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
	<link rel="stylesheet" href="{{ URL::to('/') }}/css/forum.css">

    <script src="{{ URL::to('/') }}/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076c9a6eb.js" crossorigin="anonymous"></script>
   
  </head>

  <body>
    @include('partials.navbar')
  
    <div class="container-fluid" id="main">
        {{-- ambil dari halaman lain --}}
        @yield('container')
    </div>
    @include('partials.footer')


    
  </body>
</html>
