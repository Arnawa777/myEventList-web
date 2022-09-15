{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/card.css">

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <ul class="cards">
                @foreach ($people as $person)
                <li>
                <a href="/people/{{ $person->slug }}" class="card">
                    <img src="/storage/person-picture/{{ $person->picture }}" class="card__image" alt="" />
                    <div class="card__overlay">
                    <div class="card__header">
                        <div class="card__header-text">
                        <h3 class="card__title">{{ $person->name }}</h3>
                        </div>
                    </div>
                        <p class="card__description">
                        @if (is_null($person->biography))
                            This person doesn't have biography yet...
                        @else
                            {{-- {!!  Str::limit($person->synopsis, 50, $end='...')  !!} --}}
                            {!!  substr(strip_tags($person->biography), 0, 50) !!}...
                            
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