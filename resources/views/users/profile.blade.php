{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
    
<div class="container mt-4">
    <div class="row">
        <div class="col-sm-4">
			<div class="card">
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
						@if (auth()->user() == $user)
						<a href="/setting/profile">Edit Profile</a>
						@endif
					</h3>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">Last Online 1 Minutes Ago</li>
					<li class="list-group-item">Joined date : {{ $user->created_at->format('d F Y'); }}</li>
					<li class="list-group-item">Posts Forum : {{ $user->posts_count }}</li>
				</ul>
				<div class="card-body">
					<a href="/profile/{{ $user->username }}/favorites">
					<button>Event List</button>
					</a>
				</div>
			</div>
        </div>
        <div class="col-sm-6">
			<div class="card">
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
				<h5 class="card-title">Favorites</h5>
				{{-- {{ dd($favorites) }} --}}
					<p class="card-text">
					@forelse ($favorites as $favorite)
						<li>{{ $favorite->event->name }}</li>
					@empty
						<p>No Favorite</p>
					@endforelse
					
					
					
					</p>
				</div>
			</div>
        </div>
    </div>
</div>

@endsection