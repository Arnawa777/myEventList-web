{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/card.css">

<div class="container">
    <div class="row">
        <div style="display: flex; justify-content: center;">
            <div class="col-lg-6">
                <h1 class="mb-3 text-center" style="padding-top: 20px">{{ $title }}</h1>
                <form action="/events">
                    <div class="input-group mb-3">
                        <select class="form-select" id="category" name="category" value="{{ request('category') }}">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                @if (request('category') == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif  
                            @endforeach
                        </select>
                        <select class="form-select" id="location" name="location" value="{{ request('location') }}">
                            <option value="">Select Location</option>
                            @foreach ($locations as $location)
                                @if (request('location') == $location->regency)
                                    <option value="{{ $location->regency }}" selected>{{ $location->regency }}</option>
                                @else
                                    <option value="{{ $location->regency }}">{{ $location->regency }}</option>
                                @endif  
                            @endforeach
                        </select>
                        <input type="text" class="form-control" placeholder="Search.." 
                        name="search" value="{{ request('search') }}" id="deleteInput">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-12">
            @if ($events->count())
                <ul class="cards">
                    @foreach ($events as $event)
                    <li>
                    <a href="/events/{{ $event->slug }}" class="card">
                        <div class="parent-cover-event" style="margin-bottom:100px;">
                            @if($event->picture)
                                <img class="cover-event" src="/storage/event-picture/{{ $event->picture }}" alt="event-img">
                            @else
                                <img class="cover-event-empty" src="/img/No_image_available.svg" alt="no-img">
                            @endif
                        </div>
                        <div class="card__overlay">
                            <div class="card__header">
                                <div class="card__header-text">
                                <h3 class="card__title">{{ $event->name }}</h3>            
                                <span class="card__status">{{ $event->category->name }} - {{ $event->location->regency}}</span>
                                </div>
                            </div>
                            
                            <p class="card__description">
                            @if (is_null($event->description))
                                This Event doesn't have description yet...
                            @else
                                {{-- {!!  Str::limit($event->description, 50, $end='...')  !!} --}}
                                {!!  substr(strip_tags($event->description), 0, 50) !!}...
                                
                            @endif
                            </p>
                        </div>
                    </a>
                    </li>
                    @endforeach 
                </ul>
            @else
                <p class="text-center fs-4">404 No Event Found.</p>  
            @endif
        </div>
        <div class="d-flex justify-content-end">
            {{ $events->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>


@endsection