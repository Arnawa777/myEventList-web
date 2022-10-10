{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<link rel="stylesheet" href="{{ URL::to('/') }}/css/events.css">

<div class="col-lg-9 my-4" id="land-event">
    <div class="row" style="padding: 0px 10px;">
        <div class="col-md-12" id="title">
            <h3>{{ $event->name }}</h3>
        </div>

        {{-- Button --}}
        <div style="padding-bottom: 10px">
            <a href="/dashboard/events"
            class="btn btn-info border-0">
            <span data-feather="arrow-left"></span> Kembali ke Daftar Komunitas
        </a>
        <a href="/dashboard/events/{{ $event->slug }}/edit"
            class="btn btn-warning border-0">
            <span data-feather="edit"></span> Edit
        </a>
        <form action="/dashboard/events/{{ $event->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-danger" onclick="return confirm('Apa anda yakin?')">  
            <span data-feather="x-circle"></span> Hapus</button>
            </form>
        </div>

        {{-- Left Side --}}
        <div class="col-sm-3">
            <div class="row" id="main-row">
                <div style="margin-bottom:20px;">
                    @if ($event->picture)
                        <img class="cover-event" src="/storage/event-picture/{{ $event->picture }}" alt="event-img">
                    @else
                        <img class="cover-event-empty" src="/img/No_image_available.svg" alt="no-img">
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
            </div>
        </div> <!--// close of Left Side div //-->

        {{-- Main Side --}}
        <div class="col-sm-9">
            <div id="horiznav_nav" style="margin: 0 0 10px 0;">
                <ul style="margin-right: 0; padding-right: 0;">
                      <li><a href="/dashboard/events/{{ $event->slug }}">Detail</a>
                  </li>
                      <li><a href="/dashboard/events/{{ $event->slug }}/characters">Karakter &amp; Staf</a>
                  </li>
                      <li><a href="/dashboard/events/{{ $event->slug }}/reviews">Ulasan</a>
                  </li>
                </ul>
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
                                        <a href="/dashboard/characters/{{ $ac->character->slug }}">
                                            @if ($ac->character->picture)
                                                <img class="image-icon" src="/storage/character-picture/{{ $ac->character->picture }}"  alt="character-picture">
                                            @else
                                                <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                            @endif
                                        </a>
                                    </td>
                                    <td>    
                                        <a href="/dashboard/characters/{{ $ac->character->slug }}">
                                            <h7 class="name-table">
                                                {{ Str::words($ac->character->name, 2, '') }}
                                            </h7>
                                        </a>
                                        <p class="name-table">{{ $ac->role }}</p>
                                    </td>
                                    <td align="right">
                                        <a href="/dashboard/people/{{ $ac->person->slug }}">
                                            <h7 class="name-table">
                                                {{ Str::words($ac->person->name, 2, '') }}
                                            </h7>
                                        </a>
                                        <p class="name-table">Aktor</p>
                                    </td>
                                    <td width="52px">
                                        <a href="/dashboard/people/{{ $ac->person->slug }}">
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
                        <p>Belum ada karakter dan aktor yang ditambahkan pada komunitas ini.</p>
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
                                            <a href="/dashboard/people/{{ $stf->person->slug }}">
                                                @if ($stf->person->picture)
                                                    <img class="image-icon" src="/storage/person-picture/{{ $stf->person->picture }}"  alt="person-picture">
                                                @else
                                                    <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/dashboard/people/{{ $stf->person->slug }}">
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
                        <p>Belum ada staf yang ditambahkan pada komunitas ini</p>
                    @endforelse
                </div> <!--// close of Data Chara div //-->
            </div> <!--// close of Staff div //-->
           
        </div> <!--// close of Main Side div //-->
    </div>
</div>

@endsection