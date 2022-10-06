{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')

<style>
	.index-img {
    display: block;
    width: 100%;
	max-width: 250px;
    height: 300px;
    object-fit: cover;
  }

  .index-img-empty {
    display: block;
    max-width: 250px;
    height: 300px;
    object-fit: fill;
  }
</style>

<div class="container">
	<div class="row">
		<nav class="breadcrumb">
            <a href="/users">Users </a>
            &nbsp
            >
            &nbsp
            <a href="/profile/{{ $user->username }}">{{ $user->username }}</a>
            &nbsp
            >
            &nbsp
            <a href="/profile/{{ $user->username }}/favorites" class="active">{{ $user->username }} Favorites</a>
        </nav>
		<div class="col">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">{{ $user->username }}'s Favorite</h3>
				</div>
				<div class="card-body">
					@if ($message = Session::get('error'))
						<div class="alert alert-warning">
							<p>{{ $message }}</p>
						</div>
					@endif
					@if ($message = Session::get('success'))
						<div class="alert alert-success">
							<p>{{ $message }}</p>
						</div>
					@endif
					<div class="table-responsive">
						<table class="table table-bordered">
						
						<thead>
							<tr>
							<th>No</th>
							<th style="width: 250px;">Picture</th>
							<th>Event Name</th>
							<th>Description</th>
							</tr>
						</thead>
						<tbody>
							@foreach($favorites as $favorite)
							<tr>
							<td>
								{{ $favorites->firstItem()+$loop->index }}
							</td>
							<td>
								<a href="/events/{{ $favorite->event->slug }}">
								@if ($favorite->event->picture)
									<img class="index-img" src="/storage/event-picture/{{ $favorite->event->picture }}" alt="event-img">
								@else
									<img class="index-img-empty" src="/img/No_image_available.svg" alt="no-img">
								@endif
								</a>
							</td>
							<td>
								<a href="/events/{{ $favorite->event->slug }}">
									<h5>{{ $favorite->event->name }}</h5>
								</a>
							</td>
							<td>
								@if ($favorite->event->description)
									{!! $favorite->event->description !!}
								@else
									This Event doesn't have description...
								@endif
							</td>
							@auth
								@if (Auth::user()->id == $favorite->user_id)
								<td>
									<form action="{{ route('favorites.destroy', $favorite->id) }}" method="post" class="d-inline">
									@method('delete')
									@csrf
									<button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
							
									</form>
								</td>
								@endif
							@endauth
							</tr>
							@endforeach
						</tbody>
						
						</table>
						{{ $favorites->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
