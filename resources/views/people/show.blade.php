{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')

<div class="container">
    <div class="row" style="padding: 0px 10px">
        <div class="col-md-12" id="title" style="background: #333333; color:white;">
            <h3>{{ $person->name }}</h3>
        </div>

        {{-- Left Side --}}
        <div class="col-sm-3">
            <div class="row" id="main-row" style="background: #333333; color:white;">
                <div class="parent-cover-event" style="margin-top:10px; margin-bottom:20px;">
                    @if($person->picture)
                        <img class="cover-event" style="border: 2px white solid;" src="/storage/person-picture/{{ $person->picture }}" alt="person-img">
                    @else
                        <img class="cover-event-empty" style="border: 2px white solid;" src="/img/No_image_available.svg" alt="no-img">
                    @endif
                </div>
                <div class="border-bottom" style="margin-bottom:10px;">
                    <h5>Informasi</h5>
                </div>
                <div>
                    <p> Tanggal Lahir: 
                        @if ($person->birthday)
                            {{ date('d M Y', strtotime($person->birthday)) }}
                        @else
                            Tidak diketahui
                        @endif
                    </p>
                    <p> Biografi : </p>
                    @if ($person->biography)
                        <article>
                            {!! $person->biography !!}
                        </article>
                    @else
                        Orang ini belum memiliki biografi..
                    @endif
                    
                </div>
            </div>
        </div> <!--// close of Left Side div //-->

        {{-- Main Side --}}
        <div class="col-sm-9">
            
            {{-- Person --}}
            <div class="row" id="main-row">
                <div class="col-12"> 
                    <div class="border-bottom" style="margin-bottom:10px;">
                        <h5 style="float: left;">Peran Aktor</h5>
                        <div style="clear: both;"></div>
                    </div>
                </div>
            
                <div class="col-12">
                    @if ($actors->count())
                    @foreach ($actors as $actor)
                        @foreach ($actor->actor_event as $ac)
                            <div class="first-table" style="text-align:left; float: left;">
                                <div style="display: inline-block;">
                                    <a href="/characters/{{ $actor->character->slug }}">
                                        @if ($actor->character->picture)
                                            <img class="image-icon" src="/storage/character-picture/{{ $actor->character->picture }}"  alt="character-picture">
                                        @else
                                            <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                        @endif
                                    </a>
                                </div>
                                <div class="name-table" style="display: inline-block;">
                                    <a href="/characters/{{ $actor->character->slug }}">
                                        <h5>
                                        {{ $actor->character->name }}
                                        </h5>
                                    </a>
                                    <p>
                                        {{ $actor->character->role }}
                                    </p>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="first-table" style="text-align:right; float: right;">
                                <div class="name-table" style="display: inline-block; margin-right:0;">
                                    <a href="/events/{{ $ac->event->slug }}">
                                    <h5>{{ $ac->event->name }}</h5> 
                                    </a>
                                </div>
                                <div style="display: inline-block;">
                                    <a href="/events/{{ $ac->event->slug }}">
                                        @if ($ac->event->picture)
                                            <img class="image-icon" src="/storage/event-picture/{{ $ac->event->picture }}"  alt="event-picture">
                                        @else
                                            <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <div class="clear"></div>
                        @endforeach
                    @endforeach

                    {{-- Jika data tidak ada --}}
                    @else
                    <div class="col">
                        <p>Orang ini belum memiliki peran sebagai Aktor</p>
                    </div>
                    @endif
                </div> <!--// close of Data person div //-->
            </div> <!--// close of Staff div //-->

            {{-- Staff --}}
            <div class="row" id="main-row">
                <div class="col-12"> 
                    <div class="border-bottom" style="margin-bottom:10px;">
                        <h5 style="float: left;">Peran Staf</h5>
                        <div style="clear: both;"></div>
                    </div>
                </div>
            
                
                @forelse ($staff as $stf) 
                <div class="row" style="background: white; margin: 10px; max-width:955px;">
                    <div class="col-1" style="padding-left: 0; margin-left:0px;">
                        <a href="/events/{{ $stf->event->slug }}">
                            @if ($stf->event->picture)
                                <img class="image-icon" src="/storage/event-picture/{{ $stf->event->picture }}"  alt="event-picture">
                            @else
                                <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                            @endif
                        </a>
                    </div>
                    <div class="col-11 name-table" style="padding-left:5px">
                        <a href="/events/{{ $stf->event->slug }}">
                            <h5>
                                {{ $stf->event->name }}
                            </h5>
                        </a>
                        <h6 style="padding-bottom:10px; font-style:italic; font-weight:350">
                            {{ $stf->role }}
                        </h6>
                        <h6 style="font-size:16px; font-weight:400;">
                            @if ($stf->description)
                            {{-- {!!  Str::limit($stf->description, 50, $end='...')  !!} --}}
                            
                                {!!  $stf->description !!}
                                @else
                                    Peran ini belum memiliki deskripsi...
                                @endif 
                        </h6> 
                    </div>
                </div> <!--// close of Data person div //-->
                @empty
                    <p>Orang ini belum memiliki peran sebagai Staf</p>
                @endforelse 
            </div> <!--// close of Staff div //-->
        </div>

    </div>
</div>


@endsection