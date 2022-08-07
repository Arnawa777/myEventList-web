{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/card.css">

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <ul class="cards">
                @foreach ($events as $event)
                <li>
                <a href="/events/{{ $event->slug }}" class="card">
                    <img src="/storage/event-picture/{{ $event->picture }}" class="card__image" alt="" />
                    <div class="card__overlay">
                    <div class="card__header">
                        <div class="card__header-text">
                        <h3 class="card__title">{{ $event->name }}</h3>            
                        <span class="card__status">{{ $event->category->name }}</span>
                        </div>
                    </div>
                    <p class="card__description">
                        @if (is_null($event->synopsis))
                            This Event doesn't have synopsis yet...
                        @else
                            {{-- {!!  Str::limit($event->synopsis, 50, $end='...')  !!} --}}
                            {!!  substr(strip_tags($event->synopsis), 0, 50) !!}...
                            
                        @endif
                        </p>
                    </div>
                </a>      
                </li>
                @endforeach 
            </ul>
        </div>
    </div>
</div>


@endsection