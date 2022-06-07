{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 col-lg-8 border-bottom" 
	 style="padding: 30px 0px 20px 0px">
	<h2>List Actor in Event</h2>
    <div class="search">
    	<select class="livesearch form-control" name="livesearch"></select>
    </div>
</div>


<div class="table-responsive col-lg-8">
	<div class="col-lg-8">
		<a href="/dashboard/actor-events/create" class="btn btn-primary mb-3">Assign Actor to Event</a>
  	</div>

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
					<th scope="col">Event</th>
					<th scope="col">Character</th>
					<th scope="col">Person</th>
					<th scope="col" style="width: 10%">Action</th>
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
					<td style="flex">
						{{-- Menit 36 eps 17 --}}
						<a style="pointer-events: none;" href="#"
							class="badge bg-secondary"> <i class="fa-solid fa-eye-slash"></i></a>

						<a href="/dashboard/actor-events/{{ $ae->id }}/edit"
							class="badge bg-warning"><i class="fa-solid fa-pen-to-square"></i></a>

							<form action="/dashboard/actor-events/{{ $ae->id }}" method="post" class="d-inline">
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
		{{ $actor_events->links() }}
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