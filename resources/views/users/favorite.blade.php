{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')

<div class="container">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Favorite</h3>
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
						<th>Event Name</th>
						<th>Event Synopsis</th>
						</tr>
					</thead>
					<tbody>
						@foreach($favorites as $favorite)
						<tr>
						<td>
							{{ $favorites->firstItem()+$loop->index }}
						</td>
						<td>
							{{ $favorite->event->name }}
						</td>
						<td>
							{{ $favorite->event->synopsis }}
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
