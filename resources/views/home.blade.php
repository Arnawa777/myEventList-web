{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">
<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/carousal.css">

<div class="container">
    <div class="main">
      	<div class="row">
        	<div class="col-lg-12">
				</div>
				<div class="top_slider">
					@foreach ($favorites as $favorite)
					<div class="car">
						<a href="/events/{{ $favorite->slug }}">
							<div class="card">
								<div class="card-header main-header">
									@if ($favorite->picture)
										<img class="main-img" src="/storage/event-picture/{{ $favorite->picture }}" alt="favorite-img">
									@else
										<img class="main-img" style="background: #333333; object-fit:fill" src="/img/No_image_available.svg" alt="no-img">
									@endif
									<div class="border-hover"></div>
									<div class="middle">
										<div>{{ Str::words( $favorite->name, 2,'') }}</div>
									</div>
								</div>
								<div class="main-card-body">
									<div class="card-title">{{ $favorite->name }}</div>
								</div>
							</div>
						</a>
					</div>
					@endforeach
				</div>
        	</div>
      	</div>
		<div class="row">
			<div class="col-lg-8" id="left-side">

				{{-- Event --}}
				<div class="side-title-slider">
					<h5>Daftar Komunitas terbaru</h5>
				</div>
				<div class="slider">
					@forelse ($events as $event)
					<div class="car">
						<a href="/events/{{ $event->slug }}">
							<div class="card">
								<div class="card-header side-header">
									@if ($event->picture)
										<img class="side-img" src="/storage/event-picture/{{ $event->picture }}" alt="event-img">
									@else
										<img class="side-img" style="background: #333333; object-fit:fill" src="/img/No_image_available.svg" alt="no-img">
									@endif
									<div class="border-hover"></div>
									<div class="middle">
									<div>{{ Str::words($event->name, 2, '') }}</div>
									</div>
								</div>
						
								<div class="side-card-body">
									<div class="side-title">{{ $event->name }}</div>
								</div>
							</div>
						</a>
					</div>
					@empty
						<h1>Komunitas 404</h1>
					@endforelse
				</div>
				{{-- People --}}
				<div class="side-title-slider">
					<h5>Daftar Orang Terbaru</h5>
				</div>
				<div class="slider">
					@forelse ($people as $person)
						<div class="car">
							<a href="/people/{{ $person->slug }}">
								<div class="card">
									<div class="card-header side-header">
										@if ($person->picture)
											<img class="side-img" src="/storage/person-picture/{{ $person->picture }}" alt="person-img">
										@else
											<img class="side-img" style="background: #333333; object-fit:fill" src="/img/No_image_available.svg" alt="no-img">
										@endif
										<div class="border-hover"></div>
										<div class="middle">
											<div>{{ Str::words($person->name, 2, '') }}</div>
										</div>
									</div>
						
									<div class="side-card-body">
										<div class="side-title">{{ $person->name }}</div>
									</div>
								</div>
							</a>
						</div>
					@empty
						<h1>Orang 404</h1>
					@endforelse
				</div>

				{{-- Characters --}}
				<div class="side-title-slider">
					<h5>Daftar Karakter Terbaru</h5>
				</div>
				<div class="slider">
					@forelse ($characters as $character)
					<div class="car">
						<a href="/characters/{{ $character->slug }}">
							<div class="card">
								<div class="card-header side-header">
									@if ($character->picture)
										<img class="side-img" src="/storage/character-picture/{{ $character->picture }}" alt="character-img">
									@else
										<img class="side-img" style="background: #333333; object-fit:fill" src="/img/No_image_available.svg" alt="no-img">
									@endif
									<div class="border-hover"></div>
									<div class="middle">
									<div>{{ Str::words($character->name, 2, '') }}</div>
									</div>
								</div>
					
								<div class="side-card-body">
									<div class="side-title">
										{{ $character->name }}
									</div>
								</div>
							</div>
						</a>
					</div>
					@empty
						<h1>Karakter 404</h1>
					@endforelse
				</div>
			</div>

			{{-- Right Side --}}
			{{-- Popular Forum by most Review--}}
			<div class="col-lg-4">
				<div class="card">
					<h4 class="card-title" 
					style="background-color: #74c0ff; margin: 0; padding: 10px;"
					>Komunitas Populer</h4>
					<div class="card-body">
						@forelse ($popular as $pp)
						<table class="popular-table">
							<tbody>
								<tr>
									<td style="width: 90px;">
										<a href="/events/{{ $pp->slug }}">
										@if ($pp->picture)
											<img class="small-img" src="/storage/event-picture/{{ $pp->picture }}" alt="event-img">
										@else
											<img class="small-img" style="background: #333333; object-fit:fill" src="/img/No_image_available.svg" alt="no-img">
										@endif
										</a>
									</td>
									<td class="popular-info">
										<a href="/events/{{ $pp->slug }}">
											<h5>{{ $pp->name }}</h5>
										</a>
										<p>Skor: {{ substr($pp->rating, 0, 4) }}</p>
										<p>Dari {{ $pp->member }} User</p>
									</td>
								</tr>	
							</tbody>
						</table>
						@empty
							<p>Tidak ada Komunitas populer</p>
						@endforelse
					</div>
				</div>
			</div>

		</div>

    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="{{ URL::to('/') }}/js/carousal.js"></script>
@endsection