{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">List Event</h1>
</div>

<div class="table-responsive col-lg-8">
  <a href="/dashboard/events/create" class="btn btn-primary mb-3">Create New Event</a>
  
  @if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
  @endif
  
  <table class="table table-sm">
    <thead>
      <tr class="bg-dark text-light">
        <th scope="col">#</th>
        <th scope="col">Picture</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($events as $event) 
      <tr class="bg-secondary text-light">
        <td>{{ $loop->iteration }}</td>
        <td><img class="img-fluid"  src="/storage/event-picture/{{ $event->picture }}" style="width:auto; height:100px; object-fit: cover;"></td>
        <td>{{ $event->name }}</td>
        <td>{{ $event->category->name }}</td>
        <td class="action col-sm-1 align-middle text-center">
            {{-- Menit 36 eps 17 --}}
            
              
              <form action="/dashboard/events/{{ $event->slug }}">
                <button class="badge bg-info border-0"><i class="fa-solid fa-eye" style="font-size:25px;"></i></button>
              </form>

              <form action="/dashboard/events/{{ $event->slug }}/edit">
                <button class="badge bg-warning border-0"><i class="fa-solid fa-pen-to-square" style="font-size:25px;"></i></button>
              </form>

              <form action="/dashboard/events/{{ $event->slug }}" method="event" class="d-inline">
              @method('delete')
              @csrf
              <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash" style="font-size:25px;"></i></button>
              </form> 
        </td>
      </tr>
      <tr class="spacer"><td></td></tr>
      @endforeach
    </tbody>
  </table>
</div>


@endsection