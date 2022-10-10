{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
{{-- {{ dd($allReviews) }} --}}

<div class="container">
        <div class="row" id="land-event">
            <div class="col-sm-12" id="title" style="background: #333333; color:white">
                <h3>{{ $event->name }}</h3>
            </div>
            {{-- Left Side --}}
            <div class="col-sm-3" style="background: #333333; border: 1px white solid; color:white;">
                <div class="row" id="main-row">
                    <div class="parent-cover-event" style="margin-top:10px; margin-bottom:20px;" id="event_id" data-field-id="{{ $event->id }}">
                        @if ($event->picture)
                            <img class="cover-event" style="border: 2px white solid;" src="/storage/event-picture/{{ $event->picture }}" alt="event-img">
                        @else
                            <img class="cover-event-empty" style="border: 2px white solid;" src="/img/No_image_available.svg" alt="no-img">
                        @endif
                    </div>
                    <div class="border-bottom" style="margin-bottom:10px;">
                        <h5>Informasi</h5>
                    </div>
                    <div>
                        <p> Kategori:  {{ $event->category->name }} </p>
                        @if ($event->date)
                            <p> Berdiri: {{ date('d M Y', strtotime($event->date)) }}</p>
                        @else
                            <p> Berdiri: Tidak diketahui</p>
                        @endif
                        <p> Lokasi: {{ $event->location->sub_regency }}, {{ $event->location->regency }}</p>
                        @if ($event->phone)
                            <p> Ponsel: {{ $event->phone }}</p>
                        @else
                            <p> Ponsel: Tidak diketahui</p>
                        @endif
                    </div>
                    <div>
                        @auth
                        <form action="{{ route('favorites.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="event_id" value={{ $event->id }}>
                            
                            @if($favorite)
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-heart"></i> Favorit
                            @else
                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                            <i class="far fa-heart"></i> Tambah Favorit
                            @endif
                            </button>
                          </form>
                        @endauth
                    </div>
                    
                </div>
            </div> <!--// close of Left Side div //-->

            {{-- Main Side --}}
            <div class="col-sm-9">
                <div id="horiznav_nav" style="margin: 0 0 10px 0;">
                    <ul style="margin-right: 0; padding-right: 0;">
                          <li><a href="/events/{{ $event->slug }}">Detail</a>
                      </li>
                          <li><a href="/events/{{ $event->slug }}/characters">Karakter &amp; Staf</a>
                      </li>
                          <li><a href="/events/{{ $event->slug }}/reviews">Ulasan</a>
                      </li>
                      </ul>
                      <div style="clear: left;"></div>
                </div>
                

                {{-- Character & Actor --}}
                <div class="row" id="main-row">
                    <div class="col-12"> 
                        <div class="border-bottom" style="margin-bottom:10px;">
                            <h5 style="float: left;">Karakter & Aktor</h5>
                            <div style="clear: left;"></div>
                        </div>
                    </div>
                
                    <div class="row">
                        @forelse ($actors as $ac)
                        <div class="mid-column border-bottom">
                            <table class="first-table" style="width: 100%">
                                <tbody>
                                    <tr>
                                        <td width="52px">
                                            <a href="/characters/{{ $ac->character->slug }}">
                                            @if ($ac->character->picture)
                                                <img class="image-icon" src="/storage/character-picture/{{ $ac->character->picture }}"  alt="character-picture">
                                            @else
                                                <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                            @endif
                                            </a>
                                        </td>
                                        <td>   
                                            <a href="/characters/{{ $ac->character->slug }}">
                                                <h7 class="name-table">
                                                    {{ Str::words($ac->character->name, 2, '') }}
                                                </h7>
                                            </a>        
                                            <p class="name-table">{{ $ac->role }}</p>
                                        </td>
                                        <td align="right">
                                            <a href="/people/{{ $ac->person->slug }}">
                                                <h7 class="name-table">
                                                    {{ Str::words($ac->person->name, 2, '') }}
                                                </h7>
                                            </a>
                                            <p class="name-table">Aktor</p>
                                        </td>
                                        <td width="52px">
                                            <a href="/people/{{ $ac->person->slug }}">
                                                @if ($ac->person->picture)
                                                    <img class="image-icon" src="/storage/person-picture/{{ $ac->person->picture }}"  alt="person-picture">
                                                @else
                                                    <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                                @endif
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @empty
                            <p>Belum ada Karakter dan Aktor yang ditambahkan pada Komunitas ini</p>
                        @endforelse
                    </div> <!--// close of Data Chara div //-->
                </div> <!--// close of Chara & person div //-->

                {{-- Staff --}}
                <div class="row" id="main-row">
                    <div class="col-12" id="staff"> 
                        <div class="border-bottom" style="margin-bottom:10px;">
                            <h5 style="float: left;">Staf</h5>
                            <div style="clear: left;"></div>
                        </div>
                    </div>
                
                    <div class="row">
                        @forelse ($staff as $stf)
                            <div class="mid-column border-bottom">
                                <table class="first-table" style="width: 100%">
                                    <tbody>
                                        <tr>
                                            <td width="52px">
                                                <a href="/people/{{ $stf->person->slug }}">
                                                    @if ($stf->person->picture)
                                                        <img class="image-icon" src="/storage/person-picture/{{ $stf->person->picture }}"  alt="person-picture">
                                                    @else
                                                        <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                                    @endif
                                                </a>
                                            </td>
                                            <td>
                                                <a href="/people/{{ $stf->person->slug }}">
                                                    <h7 class="name-table">
                                                        {{ Str::words($stf->person->name, 2, '') }}
                                                    </h7>
                                                </a>
                                                <p class="name-table">{{ $stf->role }}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @empty
                            <p>Belum ada Staf yang ditambahkan pada Komunitas ini</p>
                        @endforelse
                    </div> <!--// close of Data Chara div //-->
                </div> <!--// close of Staff div //-->

            
            </div> <!--// close of Main Side div //-->
        </div>
</div>

@endsection