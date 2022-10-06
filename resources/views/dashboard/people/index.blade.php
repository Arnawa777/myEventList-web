{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
	 style="padding: 30px 0px 20px 0px">
    <h2>People</h2>
</div>

<div class="table-responsive col-lg-8">
	<div style="float:left">
	<a href="/dashboard/people/create" class="btn btn-primary mb-3">Create New Person</a>
	</div>
	<div style="float: right">
		<form action="/dashboard/people">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="Search.." 
				name="search" value="{{ request('search') }}" id="deleteInput">
				<button class="btn btn-primary" type="submit" >Search</button>
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
						@if ($person->picture)
							<img class="index-img" src="/storage/person-picture/{{ $person->picture }}" alt="person-img">
						@else
							<img class="index-img-empty" src="/img/No_image_available.svg" alt="no-img">
						@endif
					</td>
					<td>{{ $person->name }}</td>
					<td>
						@if ($person->birthday)
							{{ $person->birthday }}
						@else
							Unknown
						@endif
					</td>
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