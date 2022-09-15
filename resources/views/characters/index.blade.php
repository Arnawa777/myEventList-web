{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/card.css">

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <ul class="cards">
                @foreach ($characters as $character)
                <li>
                <a href="/characters/{{ $character->slug }}" class="card">
                    <img src="/storage/character-picture/{{ $character->picture }}" class="card__image" alt="" />
                    <div class="card__overlay">
                    <div class="card__header">
                        <div class="card__header-text">
                        <h3 class="card__title">{{ $character->name }}</h3>            
                        </div>
                    </div>
                    <p class="card__description">
                        @if (is_null($character->description))
                            This character doesn't have description yet...
                        @else
                            {{-- {!!  Str::limit($character->description, 50, $end='...')  !!} --}}
                            {!!  substr(strip_tags($character->description), 0, 50) !!}...
                            
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