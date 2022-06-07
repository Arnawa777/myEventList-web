{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
	 style="padding: 30px 0px 20px 0px">
	<h2>List Actor</h2>
</div>

<div class="table-responsive col-lg-8">
	<div class="col-lg-8">
		<a href="/dashboard/actors/create" class="btn btn-primary mb-3">Make Actor</a>
	</div>

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
					<th scope="col">Description</th>
					<th scope="col" style="width:  10%">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($actors as $actor) 
				<tr>
					{{-- Loop number with pagination --}}
					<td>{{ $actors->firstItem()+$loop->index }}</td>
					<td>{{ $actor->person->name }}</td>
					<td>{{ $actor->character->name }}</td>
					<td>{{ $actor->name }}</td>
					<td>
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
  <div class="d-flex justify-content-center">
    {{ $actors->links() }}
  </div>
</div>


@endsection