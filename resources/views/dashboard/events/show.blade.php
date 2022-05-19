{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')

<div class="row mb-5">
    <div class="col-md-12 bg-secondary" >
        <h1 class="mb-3" >{{ $event->name }}</h1>
    </div>
    
</div>

<div class="row">
    <div class="col-sm-2">
        <div style="margin-bottom:20px;">
            <img class="img-fluid"  src="/storage/event-picture/{{ $event->picture }}" style="width:350px; object-fit: cover;">
        </div>
        <div class="border-bottom" style="margin-bottom:10px;">
            <h5>Information</h5>
        </div>
        <div>
            <p> Category:  {{ $event->category->name }} </p>
            <p> Location: {{ $event->location_id }}</p>
        </div>
    </div>
    <div class="col-sm-10">
        {{-- Rating & Video --}}
      <div class="row">
        <div class="col-6 col-sm-6">
            <p>Rating</p>
            <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></p>
        </div>
        <div class="col-5 col-sm-6 align-items-end">
            <img class="img-fluid"  src="/storage/event-picture/{{ $event->picture }}" style="width:150px; object-fit: cover;">
        </div>
      </div>
      {{-- Synopsis --}}
      <div class="row">
          <div class="col-10"> 
            <div class="border-bottom" style="margin-bottom:10px;">
                <h5>Synopsis</h5>
            </div>
            <article>
                {!! $event->synopsis !!}
            </article>
          </div>
      </div>
      {{-- Character & Person --}}
      <div class="row">
        <div class="col-12"> 
          <div class="border-bottom" style="margin-bottom:10px;">
              <h5>Character & Actor</h5>
          </div>
        </div>
        <div class="col-6"> 
            <div class="row">
                <div class="col">
                    <div class="flex">
                       <h1><img class="img-fluid"  src="/storage/event-picture/{{ $event->picture }}" style="width:50px; object-fit: cover;"> Wlep</h1>
                    </div>
                </div>
                <div class="col text-align-start">
                    <p>name Owo</p>
                </div>
            </div>
        </div>
        <div class="col-6"> 
            <div style="margin-bottom:10px;">
                <img class="img-fluid"  src="/storage/event-picture/{{ $event->picture }}" style="width:150px; object-fit: cover;">
            </div>
        </div>
      </div>
    </div>
  </div>


@endsection