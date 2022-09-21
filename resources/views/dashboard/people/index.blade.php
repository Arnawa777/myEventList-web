{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
	 style="padding: 30px 0px 20px 0px">
    <h2>List Person</h2>
</div>

<div class="table-responsive col-lg-8">
	<div style="text-align: left; width:49%; display: inline-block;">
	<a href="/dashboard/people/create" class="btn btn-primary mb-3">Create New Person</a>
	</div>
	<div style="text-align: right; width:50%;  display: inline-block;">
		<form method="get" action="/dashboard/people/search">
			<input type="text" placeholder="Search.." name="search" id="search">
			<button type="submit"><i class="fa fa-search"></i></button>
		</form>
	</div>
    
	
	{{-- Message --}}
	@if (session()->has('success'))
		<div class="alert alert-success" role="alert">
			{{ session('success') }}
		</div>
	@endif
  
	@if ($people->count())
		<table class="table table-sm text-nowrap">
			<thead>
				<tr>
					<th scope="col" style="width: 3%;">#</th>
					<th scope="col" style="width: 12%">Picture</th>
					<th scope="col" style="width: 50%">Name</th>
					<th scope="col" style="width: 12%">Birthday</th>
					<th scope="col" style="width: 8%">Action</th>
				</tr>
			</thead>
			<tbody style="height: 100px">
				@foreach ($people as $person) 
				<tr>
					{{-- Loop number with pagination --}}
					<td>{{ $people->firstItem()+$loop->index }}</td>
					<td>
						<img class="index-img" src="/storage/person-picture/{{ $person->picture }}">
					</td>
					<td>{{ $person->name }}</td>
					<td>{{ $person->birthday }}</td>
					<td class="action align-middle text-center">
						{{-- Menit 36 eps 17 --}}
						<form action="/dashboard/people/{{ $person->slug }}">
							<button class="badge bg-info border-0"><i class="fa-solid fa-eye"></i></button>
						</form>
			
						<form action="/dashboard/people/{{ $person->slug }}/edit">
							<button class="badge bg-warning border-0"><i class="fa-solid fa-pen-to-square"></i></button>
						</form>
						<form action="/dashboard/people/{{ $person->slug }}" method="post" class="d-inline">
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
		{{ $people->links('vendor.pagination.custom') }}
	</div>
</div>

@endsection