{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
	 style="padding: 30px 0px 20px 0px">
    <h2>Daftar Karakter</h2>
</div>

<div class="table-responsive col-lg-8">
	<div style="float: left">
		<a href="/dashboard/characters/create" class="btn btn-primary mb-3">Buat Karakter</a>
	</div>
	<div style="float: right">
		<form action="/dashboard/characters">
			<div class="input-group mb-3">
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
  
	@if ($characters->count())
		<table class="table table-sm text-nowrap">
			<thead>
				<tr>
					<th scope="col" style="width: 3%;">#</th>
					<th scope="col" style="width: 12%">Foto</th>
					<th scope="col" style="width: 50%">Nama</th>
					<th scope="col" style="width: 8%">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($characters as $chara) 
				<tr>
					{{-- Loop number with pagination --}}
					<td>{{ $characters->firstItem()+$loop->index }}</td>
					<td>
						@if ($chara->picture)
							<img class="index-img" src="/storage/character-picture/{{ $chara->picture }}" alt="chara-img">
						@else
							<img class="index-img-empty" src="/img/No_image_available.svg" alt="no-img">
						@endif
					</td>
					<td>{{ $chara->name }}</td>
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
		{{ $characters->links('vendor.pagination.custom') }}
	</div>
</div>


@endsection