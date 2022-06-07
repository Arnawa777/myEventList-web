{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
	 style="padding: 30px 0px 20px 0px">
    <h2>List Post {{ auth()->user()->username }}</h2>
</div>

<div class="table-responsive col-lg-8">
	<a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create New Post</a>
	
	{{-- Message --}}
	@if (session()->has('success'))
		<div class="alert alert-success" role="alert">
			{{ session('success') }}
		</div>
	@endif
  
	@if ($posts->count())
		<table class="table table-sm text-nowrap">
			<thead>
				<tr>
					<th scope="col" style="width: 3%;">#</th>
					<th scope="col" style="width: 12%">Picture</th>
					<th scope="col" style="width: 42%">Title</th>
					<th scope="col" style="width: 20%">Topic</th>
					<th scope="col" style="width: 8%;">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($posts as $post) 
				<tr>
					{{-- Loop number with pagination --}}
					<td>{{ $posts->firstItem()+$loop->index }}</td>
					<td>
						@if ($post->picture)
							<img class="index-img" src="/storage/post-picture/{{ $post->picture }}" alt="post-img">
						@else
							<img class="index-img" src="https://cdn.discordapp.com/attachments/729406248637956196/896117975281717358/1633607783751.jpg" alt="uwu">
						@endif
						
					</td>
					<td>{{ $post->title }}</td>
					<td>{{ $post->topic->name }}</td>
					<td class="action align-middle text-center">
						{{-- Menit 36 eps 17 --}}
						<form action="/dashboard/posts/{{ $post->slug }}">
							<button class="badge bg-info border-0"><i class="fa-solid fa-eye"></i></button>
						</form>
			
						<form action="/dashboard/posts/{{ $post->slug }}/edit">
							<button class="badge bg-warning border-0"><i class="fa-solid fa-pen-to-square"></i></button>
						</form>
						<form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
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
		{{ $posts->links('vendor.pagination.custom') }}
	</div>
</div>


@endsection