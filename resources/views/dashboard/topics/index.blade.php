{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
	 style="padding: 30px 0px 20px 0px">
    <h1 class="h2">List Topic in Post</h1>
</div>

<div class="table-responsive col-lg-8">
	<div class="col-lg-8">
		<a href="/dashboard/topics/create" class="btn btn-primary mb-3">Create New Topic</a>
	</div>

	@if (session()->has('success'))
		<div class="alert alert-success" role="alert">
			{{ session('success') }}
		</div>
	@endif

	@if (session()->has('fail'))
		<div class="alert alert-danger" role="alert">
			{{ session('fail') }}
		</div>
	@endif
  
	@if ($topics->count())
		<table class="table table-sm text-nowrap">
			<thead>
				<tr>
					<th scope="col" style="width: 3%;">#</th>
					<th scope="col">Topic</th>
					<th scope="col" style="width:  10%">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($topics as $category) 
				<tr>
				{{-- Loop number with pagination --}}
				<td>{{ $topics->firstItem()+$loop->index }}</td>
				<td>{{ $category->name }}</td>
				<td style="flex">
					{{-- Menit 36 eps 17 --}}
					<a style="pointer-events: none;" href="#" 
					class="badge bg-secondary"><i class="fa-solid fa-eye-slash"></i></a>

					<a href="/dashboard/topics/{{ $category->slug }}/edit"
						class="badge bg-warning"><i class="fa-solid fa-pen-to-square"></i></a>

						<form action="/dashboard/topics/{{ $category->slug }}" method="post" class="d-inline">
						@method('delete')
						@csrf
						<button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></button>
						</form> 
				</td>
				</tr>
				{{-- <tr class="spacer"><td></td></tr> --}}
				@endforeach
			</tbody>
    	</table>
	@else
		<p class="text-center fs-4">404</p>
		<p class="text-center fs-4">Data Not Found</p>
	@endif
	<div class="d-flex justify-content-center">
		{{ $topics->links() }}
	</div>
</div>


@endsection