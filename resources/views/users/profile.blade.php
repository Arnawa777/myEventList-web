{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
    
<div class="container mt-4">
    <div class="row" >
        <div class="col-sm-4">
			<div class="card" style="min-height: 700px;">
				<img class="img-fluid"  src="/storage/user-picture/{{ $user->picture }}" style="width:100%; height:300px; object-fit: cover;">
				<div class="card-body">
					<h3>
						@if (is_null($user->name))
							{{ $user->username }}'s Profile
						@else
							{{ Str::words($user->name, 2, '') }}'s Profile
							<p style="font-size: 15px;">{{ $user->username }}</p>
						@endif
						{{-- Cek profile yang dibuka merupakan user yang sedang login --}}
					</h3>
					<h4>
						@if (auth()->user() == $user)
							<a href="/setting/profile">Edit Profile</a>
						@endif
					</h4>
				</div>
				<ul class="list-group list-group-flush">
					{{-- <li class="list-group-item">Last Online 1 Minutes Ago</li> --}}
					<li class="list-group-item">Joined date : {{ $user->created_at->format('d F Y'); }}</li>
					<li class="list-group-item">Posts Forum : {{ $user->posts_count }}</li>
				</ul>
				<div class="card-body">
					<a href="/profile/{{ $user->username }}/favorites">
						<button>Favorites List</button>
					</a>
					<a href="/profile/{{ $user->username }}/posts">
						<button>Posts List</button>
					</a>
				</div>
			</div>
        </div>
        <div class="col-sm-8">
			<div class="card" style="min-height: 700px;">
				{{-- Bio --}}
				<div class="card-body">
				<h5 class="card-title">Biography</h5>
					<p class="card-text">
					@if (is_null($user->biography))
						<p> This user doesn't have biography yet... </p>
					@else
						{!! $user->biography !!}
					@endif
					</p>
				</div>
				{{-- Bio --}}
				<div class="card-body">
				<h5 class="card-title ">Favorites</h5>

				{{-- {{ dd($favorites) }} --}}
					
				@forelse ($favorites as $favorite)
					<div class="parent-card">
						<div class="parent-img">
							<a href="/events/{{ $favorite->event->slug }}">
								@if($favorite->event->picture)
									<img class="cover-event" src="/storage/event-picture/{{ $favorite->event->picture }}" alt="event-img">
								@else
									<img class="cover-event-empty" src="/img/No_image_available.svg" alt="no-img">
								@endif
							</a>
						</div>
						<div class="event-name">
							<a href="/events/{{ $favorite->event->slug }}">
							<p>
								{{ $favorite->event->name }}
							</p>
							</a>
						</div>
						
					</div>
				@empty
					<p>No Favorite</p>
				@endforelse

						
				</div>
			</div>
        </div>
    </div>
</div>

<style>

.card-body{
	flex: 0;
}

.card-title{
	border-bottom: 2px rgb(104, 101, 101) solid;
}

.parent-card{
	text-align: center;
	margin:0 10px;
	margin-bottom: 20px;
	width: 170px;
  	height: 270px;
	display: inline-block;
    overflow: hidden;
    /* text-overflow: ellipsis; */
    /* white-space: nowrap; */
}
.parent-img {
	border: 2px black solid;
  overflow: hidden;
  height: 250px;
}

.cover-event {
  width: 100%;
  height: 100%;
  display: block;
  object-position: center;
  object-fit: cover;
}

.cover-event-empty {
  display: block;
  width: 100%;
  height: 100%;
  object-position: center;
  object-fit: contain;
  /* object-fit: cover; */
}

.event-name{
	font-size: 14px;
	font-weight: 500;
}

.event-name a:any-link{
	color: black;
}

</style>

@endsection