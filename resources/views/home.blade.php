{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}



<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">
<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/carousal.css">

<div class="container ">
    <h1>Hello World</h1>
    <h2 class="text-end">World Hello</h2>

    <div class="main">
      	<div class="row">
        	<div class="col-lg-12">
				<div class="top_slider">
					@foreach ($favorites as $favorite)
					<div class="car">
						<div class="card">
							<div class="card-header">
								<img src="/storage/event-picture/{{ $favorite->picture }}">
								<div id="" class="middle">
									<div class="text">{{ $favorite->name }}</div>
								</div>
							</div>
							<div class="card-body">
							<div class="card-content">
							<div class="card-title">{{ $favorite->name }}</div>
				
							</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
        	</div>
      	</div>
		<div class="row">
			<div class="col-lg-8">
			{{ $popular }}
			{{-- Event --}}
			<div class="header-slider">
				<h5>Latest Updated Event</h5>
			</div>
			<div class="slider">
				@foreach ($events as $event)
				<div class="car">
					<div class="card">
						<div class="card-header">
							<img src="/storage/event-picture/{{ $event->picture }}">
							<div id="" class="middle">
							<div class="text">{{ $event->name }}</div>
							</div>
						</div>
				
						<div class="card-body">
							<div class="card-content">
							<div class="card-title">{{ $event->name }}</div>
				
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			{{-- People --}}
			<div class="header-slider">
				<h5>Latest Updated People</h5>
			</div>
			<div class="slider">
				@foreach ($people as $person)
				<div class="car">
					<div class="card">
					<div class="card-header">
						<img src="/storage/person-picture/{{ $person->picture }}">
						<div id="" class="middle">
						<div class="text">{{ $person->name }}</div>
						</div>
					</div>
			
					<div class="card-body">
						<div class="card-content">
						<div class="card-title">{{ $person->name }}</div>
			
						</div>
					</div>
					</div>
				</div>
				@endforeach
			</div>
			{{-- Characters --}}
			<div class="header-slider">
				<h5>Latest Updated Character</h5>
			</div>
			<div class="slider">
				@foreach ($characters as $character)
				<div class="car">
					<div class="card">
					<div class="card-header">
						<img src="/storage/character-picture/{{ $character->picture }}">
						<div id="" class="middle">
						<h1> Wlep gan Gasken aja</h1>
						</div>
					</div>
			
					<div class="card-body">
						<div class="card-content">
						<div class="card-title">
							{{ $character->name }}
						</div>
			
						</div>
					</div>
					</div>
				</div>
				@endforeach
			</div>
			</div>
			{{-- Right Side --}}
			{{-- Popular Forum Maybe--}}
			<div class="col-lg-4">
				@foreach ($characters as $character)
				<div class="card">
					<div class="card-header">
					<img src="/storage/character-picture/{{ $character->picture }}">
					<div id="" class="middle">
						<h1> Wlep gan Gasken aja</h1>
					</div>
					</div>
			
					<div class="card-body">
					<div class="card-content">
						<div class="card-title">
							{{ $character->name }}
						</div>
			
					</div>
					</div>
				</div>
				@endforeach
			</div>

		</div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="{{ URL::to('/') }}/js/carousal.js"></script>
@endsection