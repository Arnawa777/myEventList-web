{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 col-lg-8 border-bottom" 
	 style="padding: 30px 0px 20px 0px">
	<h2>Daftar Aktor pada Komunitas</h2>
</div>


<div class="table-responsive col-lg-8">
	<div style="float: left">
		<a href="/dashboard/actor-events/create" class="btn btn-primary mb-3">Tetapkan Aktor</a>
  	</div>
	<div style="float: right">
		<form action="/dashboard/actor-events">
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
  
 	@if ($actor_events->count())
		<table class="table table-sm text-nowrap">
			<thead>
				<tr>
					<th scope="col" style="width: 3%;">#</th>
					<th scope="col" style="width: 30%">Komunitas</th>
					<th scope="col" style="width: 25%">Karakter</th>
					<th scope="col" style="width: 25%">Orang</th>
					<th scope="col" style="width: 7%">Peran</th>
					<th scope="col" style="width: 10%">Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($actor_events as $ae)
				{{-- <tr class="spacer"><td colspan="5"></td></tr>  --}}
				<tr>
					{{-- Loop number with pagination --}}
					<td>{{ $actor_events->firstItem()+$loop->index }}</td>
					<td>{{ $ae->event->name }}</td>
					<td>{{ $ae->actor->character->name }}</td>
					<td>{{ $ae->actor->person->name }}</td>
					<td>{{ $ae->role }}</td>
					<td class="actionButton" style="flex">
						{{-- Menit 36 eps 17 --}}
						<a style="pointer-events: none;" href="#"
							class="badge bg-secondary"> <i class="fa-solid fa-eye-slash"></i></a>

						<a href="/dashboard/actor-events/{{ $ae->id }}/edit"
							class="badge bg-warning"><i class="fa-solid fa-pen-to-square"></i></a>

							<form action="/dashboard/actor-events/{{ $ae->id }}" method="post" class="d-inline">
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
		{{ $actor_events->links('vendor.pagination.custom') }}
	</div>
</div>

<script type="text/javascript">
	$('.livesearch').select2({
		placeholder: 'Search',
		ajax: {
			url: '/dashboard/actor-events/search',
			dataType: 'json',
			delay: 250,
			processResults: function (data) {
				return {
					results: $.map(data, function (item) {
						return {
							href: item.slug,
							text: item.name,
							id: item.id
						}
					})
				};
			},
			cache: true
		}
	});
</script>

@endsection