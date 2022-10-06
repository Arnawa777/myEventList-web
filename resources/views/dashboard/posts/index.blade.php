{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
	 style="padding: 30px 0px 20px 0px">
    <h2>Posts</h2>
</div>

<div class="table-responsive col-lg-8">
	<div style="float: left">
	<a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create New Post</a>
	</div>
	<div style="float: right">
		<form action="/dashboard/posts">
			<div class="input-group mb-3">
				<select class="form-select" id="topic" name="topic" value="{{ request('topic') }}">
					<option value="">Select Topic</option>
					@foreach ($topics as $topic)
						@if (request('topic') == $topic->id)
							<option value="{{ $topic->id }}" selected>{{ $topic->topic }} - {{ $topic->sub_topic }}</option>
						@else
							<option value="{{ $topic->id }}">{{ $topic->topic }} - {{ $topic->sub_topic }}</option>
						@endif  
					@endforeach
				</select>
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
  
	@if ($posts->count())
		<table class="table table-sm text-nowrap">
			<thead>
				<tr>
					<th scope="col" style="width: 3%;">#</th>
					<th scope="col" style="width: 12%">Picture</th>
					<th scope="col" style="width: 22%">Title</th>
					<th scope="col" style="width: 20%">Create by</th>
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
							<img class="index-img-empty" src="/img/No_image_available.svg" alt="no-img">
						@endif
					</td>
					<td>
						{{-- {{   Str::limit($post->title, 30, $end='..')   }} --}}
						{{ $post->title }}
					</td>
					<td>{{ $post->author->username }}</td>
					<td>{{ $post->topic->topic }} - {{ $post->topic->sub_topic }}</td>
					<td class="action align-middle text-center">
						{{-- Menit 36 eps 17 --}}
						<form action="/dashboard/posts/{{ $post->slug }}">
							<button class="badge bg-info border-0"><i class="fa-solid fa-eye"></i></button>
						</form>

						{{-- Check user --}}
						@if ($post->author->id === auth()->user()->id)
							<form action="/dashboard/posts/{{ $post->slug }}/edit">
								<button class="badge bg-warning border-0"><i class="fa-solid fa-pencil"></i></button>
							</form>
						@else
							{{-- Pake form krn males ganti CSSnya CAPEK --}}
							<form action="">
								<button disabled class="badge bg-secondary border-0"><i class="fa-solid fa-pencil"></i></button>
							</form>
						@endif

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