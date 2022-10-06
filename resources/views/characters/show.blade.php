{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')


<div class="container">
    <div class="row" style="padding: 0px 10px">
        <div class="col-lg-12" id="title" style="background: #333333; color:white;">
            <h3 class="mb-3" >{{ $chara->name }}</h3>
        </div>

        {{-- Left Side --}}
        <div class="col-sm-3">
            <div class="row" id="main-row" style="background: #333333; color:white;">
                <div class="parent-cover-event" style="margin-top:10px; margin-bottom:20px;">
                    @if($chara->picture)
                        <img class="cover-event" style="border: 2px white solid;" src="/storage/character-picture/{{ $chara->picture }}" >
                    @else
                        <img class="cover-event-empty" style="border: 2px white solid;" src="/img/No_image_available.svg" alt="no-img">
                    @endif
                </div>
                <div class="border-bottom" style="margin-bottom:10px;">
                    <h5 style="float: left;">Event</h5>
                    <div style="clear: both;"></div>
                </div>
                {{-- Event --}}
                <div>
                    @if ($eventList->count())
                    @foreach ($eventList as $eventL)
                    <div class="mid-column" style="margin-bottom: 10px;">
                        <table class="second-table" style="background: rgba(255, 255, 255, 0.922)">
                            <tbody>
                                <tr>
                                    <td width="52px">
                                        <a href="/events/{{ $eventL->event->slug }}">
                                            @if($eventL->event->picture)
                                            <img class="image-icon" src="/storage/event-picture/{{ $eventL->event->picture }}"  alt="event-picture">
                                            @else
                                            <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                            @endif
                                        </a>
                                    </td>
                                    <td class="name-table" style="color: #333333">
                                        <a href="/events/{{ $eventL->event->slug }}">
                                        <h7>
                                            {{ $eventL->event->name }}
                                        </h7>
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
                        <p>This Character Doesn't Have Event</p>
                    </div>
                    @endif
                </div> <!--// close of Data Event div //-->
            </div>
        </div> <!--// close of Left Side div //-->

        {{-- Main Side --}}
        <div class="col-sm-9">
    
            {{-- Description --}}
            <div class="row" id="main-row">
                <div class="col-12"> 
                    <div class="border-bottom" style="margin-bottom:10px;">
                        <h5>Description</h5>
                    </div>
                    @if (is_null($chara->description))
                        <p> This Character doesn't have description yet... </p>
                    @else
                        <article>
                            {!! $chara->description !!}
                        </article>
                    @endif
                </div>
            </div>
            
            {{-- Actor --}}
            <div class="row" id="main-row">
                <div class="col-12"> 
                    <div class="border-bottom" style="margin-bottom:10px;">
                        <h5 style="float: left;">Actor</h5>
                        <div style="clear: both;"></div>
                    </div>
                </div>
                <div class="row">
                    @if ($actors->count())
                    @foreach ($actors as $actor)
                    <div class="mid-column">
                        <table class="second-table">
                            <tbody>
                                <tr>
                                    <td width="52px">
                                        <a href="/people/{{ $actor->person->slug }}">
                                        @if($actor->person->picture)
                                            <img class="image-icon" src="/storage/person-picture/{{ $actor->person->picture }}"  alt="person-picture">
                                        @else
                                            <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                        @endif
                                        </a>
                                    </td>
                                    <td class="name-table">
                                        <a href="/people/{{ $actor->person->slug }}">
                                        <h7>
                                            {{ $actor->person->name }}
                                        </h7>
                                        </a>
                                        @if ($actor->person->birthday)
                                            <p>{{ $actor->person->birthday }} </p>
                                        @else
                                            <p>Unknown</p>
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
                        <p>This Characters Doesn't Have Actor</p>
                    </div>
                    @endif
                </div> 
            </div> <!--// close of Data Actor div //-->
            
        </div> <!--// close of Main Side div //-->
    </div>
</div>

@endsection