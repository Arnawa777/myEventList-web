{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
	 style="padding: 30px 0px 20px 0px">
	<h2>Actors</h2>
</div>

<div class="table-responsive col-lg-8">
	<div style="float: left">
		<a href="/dashboard/actors/create" class="btn btn-primary mb-3">Create New Actor</a>
	</div>
	<div style="float: right">
		<form action="/dashboard/actors">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="Search.." 
				name="search" value="{{ request('search') }}" id="deleteInput">
				<button class="btn btn-primary" type="submit">Search</button>
			</div>
		</form>
	</div>
	<div class="clear"></div>

	{{-- Message --}}
	@if (session()->has('success'))
		<div class="alert alert-success" role="alert">
			{{ session('success') }}
		</div>
	@endif
  
	@if ($actors->count())
		<table class="table table-sm text-nowrap">
			<thead>
				<tr>
					<th scope="col" style="width: 3%;">#</th>
					<th scope="col">Person Name</th>
					<th scope="col">Character Name</th>
					<th scope="col" style="width:  10%">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($actors as $actor) 
				<tr>
					{{-- Loop number with pagination --}}
					<td>{{ $actors->firstItem()+$loop->index }}</td>
					<td>
						{{-- {{ Str::limit($actor->person->name, 50, $end='..') }} --}}
						{{ $actor->person->name }}
					</td>
					<td>
						{{-- {{ Str::limit($actor->character->name, 50, $end='..') }} --}}
						{{ $actor->character->name }}
					</td>
					<td class="actionButton">
						{{-- Menit 36 eps 17 --}}
						<a style="pointer-events: none;" href="#"
							class="badge bg-secondary"><i class="fa-solid fa-eye-slash"></i></a>

						<a href="/dashboard/actors/{{ $actor->id }}/edit"
							class="badge bg-warning"><i class="fa-solid fa-pen-to-square"></i></a>

							<form action="/dashboard/actors/{{ $actor->id }}" method="post" class="d-inline">
							@method('delete')
							@csrf
							<button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></button>
							</form> 
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<p class="text-center fs-4">404</p>
		<p class="text-center fs-4">Data Not Found</p>
	@endif
	<div class="d-flex justify-content-end">
		{{ $actors->links('vendor.pagination.custom') }}
	</div>
</div>


@endsection