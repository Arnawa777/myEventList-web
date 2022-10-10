{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
	 style="padding: 30px 0px 20px 0px">
    <h2>Daftar Komunitas</h2>
</div>

<div class="table-responsive col-lg-8">
	<div style="float: left">
		<a href="/dashboard/events/create" class="btn btn-primary mb-3">Buat Komunitas</a>
	</div>
	<div style="float: right">
		<form action="/dashboard/events">
			<div class="input-group mb-3">
				<select class="form-select" id="category" name="category" value="{{ request('category') }}">
					<option value="">Pilih Kategori</option>
					@foreach ($categories as $category)
						@if (request('category') == $category->id)
							<option value="{{ $category->id }}" selected>{{ $category->name }}</option>
						@else
							<option value="{{ $category->id }}">{{ $category->name }}</option>
						@endif  
					@endforeach
				</select>
				<select class="form-select" id="location" name="location" value="{{ request('location') }}">
					<option value="">Pilih Lokasi</option>
					@foreach ($locations as $location)
						@if (request('location') == $location->regency)
							<option value="{{ $location->regency }}" selected>{{ $location->regency }}</option>
						@else
							<option value="{{ $location->regency }}">{{ $location->regency }}</option>
						@endif  
					@endforeach
				</select>
				<input type="text" class="form-control" placeholder="Pencarian.." 
				name="search" value="{{ request('search') }}" id="deleteInput">
				<button class="btn btn-primary" type="submit" >Cari</button>
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
  
	@if ($events->count())
		<table class="table table-sm text-nowrap">
			<thead>
				<tr>
					<th scope="col" style="width: 3%; text-align:center;">#</th>
					<th scope="col" style="width: 12%">Foto</th>
					<th scope="col" style="width: 35%">Nama</th>
					<th scope="col" style="width: 15%">Lokasi</th>
					<th scope="col" style="width: 12%">Kategori</th>
					<th scope="col" style="width: 8%">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($events as $event) 
				<tr>
					<td style="text-align:center;">{{ $events->firstItem()+$loop->index }}</td>
					<td>
						@if ($event->picture)
							<img class="index-img" src="/storage/event-picture/{{ $event->picture }}" alt="event-img">
						@else
							<img class="index-img-empty" src="/img/No_image_available.svg" alt="no-img">
						@endif
					</td>
					<td>
						{{-- {{ Str::limit($event->name, 40, $end='..') }} --}}
						{{ $event->name }}
					</td>
					<td>{{ $event->location->regency }}</td>
					<td>{{ $event->category->name }}</td>
					<td class="action align-middle text-center">
						{{-- Menit 36 eps 17 --}}
						<form action="/dashboard/events/{{ $event->slug }}">
							<button class="badge bg-info border-0"><i class="fa-solid fa-eye"></i></button>
						</form>

						<form action="/dashboard/events/{{ $event->slug }}/edit">
							<button class="badge bg-warning border-0"><i class="fa-solid fa-pen-to-square"></i></button>
						</form>

						<form action="/dashboard/events/{{ $event->slug }}" method="post" class="d-inline">
						@method('delete')
						@csrf
						<button class="badge bg-danger border-0" onclick="return confirm('Apa anda yakin?')"><i class="fa-solid fa-trash"></i></button>
						</form> 
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<p class="text-center fs-4">404</p>
		<p class="text-center fs-4">Data tidak ditemukan</p>
	@endif
	
	<div class="d-flex justify-content-end">
		{{ $events->links('vendor.pagination.custom') }}
	</div>
</div>


@endsection