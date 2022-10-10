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
                    <div class="input-group mb-3" style="justify-content:center">
                        <input type="text" class="form-control" placeholder="Pencarian.." 
                        name="search" value="{{ request('search') }}" id="deleteInputLong">
                        <button class="btn btn-primary" type="submit">Cari</button>
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
                        <div class="parent-cover-event" style="margin-bottom:100px;">
                            @if($character->picture)
                                <img class="cover-event" src="/storage/character-picture/{{ $character->picture }}" alt="chara-img">
                            @else
                                <img class="cover-event-empty" src="/img/No_image_available.svg" alt="no-img">
                            @endif
                        </div>
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
                                Karakter ini belum memiliki deskripsi...
                            @endif
                        </p>
                        </div>
                    </a>      
                    </li>
                    @endforeach 
                </ul>
            @else
                <p class="text-center fs-4">404 Karakter tidak ditemukan</p>  
            @endif
        </div>
        <div class="d-flex justify-content-end">
            {{ $characters->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>


@endsection