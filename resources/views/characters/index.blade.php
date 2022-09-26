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
                <form action="/characters">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search.." 
                        name="search" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit" >Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-12">
            @if ($characters->count())
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
                            @if ($character->description)
                            {{-- {!!  Str::limit($character->description, 50, $end='...')  !!} --}}
                            {!!  substr(strip_tags($character->description), 0, 50) !!}...
                            @else
                                This character doesn't have description yet...
                            @endif
                        </p>
                        </div>
                    </a>      
                    </li>
                    @endforeach 
                </ul>
            @else
                <p class="text-center fs-4">404 No Character Found.</p>  
            @endif
        </div>
        <div class="d-flex justify-content-end">
            {{ $characters->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>


@endsection