{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')

<div class="container">
    <div class="row" id="search-result">
        <div style="width:75%; margin:auto;">
            <div>
                <div class="col-lg-12">
                    <h1 class="mb-3 text-center" style="padding-top: 20px">{{ $title }}</h1>
                    <form action="/search">
                        <div class="input-group mb-3" style="justify-content: center">
                            <input type="text" class="form-control" placeholder="Pencarian.." 
                            name="search" value="{{ request('search') }}" id="deleteInputLong">
                            <button class="btn btn-primary" type="submit" >Cari</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Event --}}
            <div class="row" id="main-row" style="justify-content: center">
                <div class="col-12"> 
                    <div style="margin-bottom:10px; border-bottom:2px solid #c0c0c0;">
                        <h5 style="float: left;">Daftar Komunitas</h5>
                        <div style="clear: both;"></div>
                    </div>
                </div>
                {{-- Data Event --}}
                <div class="row">
                    @if ($events->count())
                    @foreach ($events as $event)
                    <div class="mid-column">
                        <table class="second-table">
                            <tbody>
                                <tr>
                                    <td width="52px">
                                    <a href="/events/{{ $event->slug }}">
                                        @if ($event->picture)
                                            <img class="image-icon" src="/storage/event-picture/{{ $event->picture }}"  alt="event-picture">
                                        @else
                                            <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                        @endif
                                    </a>
                                    </td>
                                    <td class="name-table">
                                        <a href="/events/{{ $event->slug }}">
                                        <h5>
                                            {{ $event->name }}
                                        </h5>
                                        </a>
                                        <p>{{ $event->category->name }} </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endforeach

                    {{-- Jika data tidak ada --}}
                    @else
                    <div class="col">
                        <p class="text-center fs-4">404 Tidak ada Komunitas yang sama</p>
                    </div>
                    @endif
                </div> <!--// close of Data Event div //-->
            </div> <!--// close of Event div //-->

            {{-- People --}}
            <div class="row" id="main-row" style="justify-content: center">
                <div class="col-12"> 
                    <div style="margin-bottom:10px; border-bottom:2px solid #c0c0c0;">
                        <h5 style="float: left;">Daftar Orang</h5>
                        <div style="clear: both;"></div>
                    </div>
                </div>
                {{-- Data People --}}
                <div class="row">
                    @if ($people->count())
                    @foreach ($people as $person)
                    <div class="mid-column">
                        <table class="second-table">
                            <tbody>
                                <tr>
                                    <td width="52px">
                                        <a href="/people/{{ $person->slug }}">
                                            @if ($person->picture)
                                                <img class="image-icon" src="/storage/person-picture/{{ $person->picture }}"  alt="person-picture">
                                            @else
                                                <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                            @endif
                                        </a>
                                    </td>
                                    <td class="name-table">
                                        <a href="/people/{{ $person->slug }}">
                                        <h5>
                                            {{ $person->name }}
                                        </h5>
                                        </a>
                                        @if ($person->birthday)
                                            <p>{{ $person->birthday }} </p>
                                        @else
                                            <p>Tanggal Lahir tidak diketahui</p>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endforeach

                    {{-- Jika data tidak ada --}}
                    @else
                    <div class="col">
                        <p class="text-center fs-4">404 Tidak ada Orang yang sama</p>
                    </div>
                    @endif
                </div> <!--// close of Data People div //-->
            </div> <!--// close of People div //-->


            {{-- Characters --}}
            <div class="row" id="main-row" style="justify-content: center">
                <div class="col-12"> 
                    <div style="margin-bottom:10px; border-bottom:2px solid #c0c0c0;">
                        <h5 style="float: left;">Karakter</h5>
                        <div style="clear: both;"></div>
                    </div>
                </div>
                {{-- Data Characters --}}
                <div class="row">
                    @if ($characters->count())
                    @foreach ($characters as $character)
                    <div class="mid-column">
                        <table class="second-table">
                            <tbody>
                                <tr>
                                    <td width="52px">
                                        <a href="/characters/{{ $character->slug }}">
                                            @if ($character->picture)
                                            <img class="image-icon" src="/storage/character-picture/{{ $character->picture }}"  alt="character-picture">
                                        @else
                                            <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                        @endif
                                        </a>
                                    </td>
                                    <td class="name-table">
                                        <a href="/characters/{{ $character->slug }}">
                                        <h5>
                                            {{ $character->name }}
                                        </h5>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endforeach

                    {{-- Jika data tidak ada --}}
                    @else
                    <div class="col">
                        <p class="text-center fs-4">404 Tidak ada Karakter yang sama</p>
                    </div>
                    @endif
                </div> <!--// close of Data Characters div //-->
            </div> <!--// close of Characters div //-->
        </div>
    </div>
</div>

@endsection