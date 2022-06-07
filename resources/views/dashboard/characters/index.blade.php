{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
	 style="padding: 30px 0px 20px 0px">
    <h2>List Character</h2>
</div>

<div class="table-responsive col-lg-8">
	<a href="/dashboard/characters/create" class="btn btn-primary mb-3">Create New Character</a>
	
	{{-- Message --}}
	@if (session()->has('success'))
		<div class="alert alert-success" role="alert">
			{{ session('success') }}
		</div>
	@endif
  
	@if ($characters->count())
		<table class="table table-sm text-nowrap">
			<thead>
				<tr>
					<th scope="col" style="width: 3%;">#</th>
					<th scope="col" style="width: 12%">Picture</th>
					<th scope="col" style="width: 50%">Name</th>
					<th scope="col" style="width: 12%">Role</th>
					<th scope="col" style="width: 8%">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($characters as $chara) 
				<tr>
					{{-- Loop number with pagination --}}
					<td>{{ $characters->firstItem()+$loop->index }}</td>
					<td>
						<img class="index-img" src="/storage/character-picture/{{ $chara->picture }}">
					</td>
					<td>{{ $chara->name }}</td>
					<td>{{ $chara->role }}</td>
					<td class="action align-middle text-center">
						{{-- Menit 36 eps 17 --}}
						<form action="/dashboard/characters/{{ $chara->slug }}">
							<button class="badge bg-info border-0"><i class="fa-solid fa-eye"></i></button>
						</form>
			
						<form action="/dashboard/characters/{{ $chara->slug }}/edit">
							<button class="badge bg-warning border-0"><i class="fa-solid fa-pen-to-square"></i></button>
						</form>
						<form action="/dashboard/characters/{{ $chara->slug }}" method="post" class="d-inline">
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
		{{ $characters->links('vendor.pagination.custom') }}
	</div>
</div>


@endsection