{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
<link rel="stylesheet" href="{{ URL::to('/') }}/css/events.css">


<div class="container">
    <div class="row" style="padding: 0px 10px">
        <div class="col-lg-12" id="title">
            <h3 class="mb-3" >{{ $chara->name }}</h3>
        </div>

        {{-- Left Side --}}
        <div class="col-sm-3">
            <div class="row" id="main-row">
                <div style="margin-bottom:20px;">
                    <img class="cover-event" src="/storage/character-picture/{{ $chara->picture }}" >
                </div>
                <div class="border-bottom" style="margin-bottom:10px;">
                    <h5 style="float: left;">Event</h5>
                    <div style="clear: both;"></div>
                </div>
                {{-- Event --}}
                <div>
                    @if ($eventList->count())
                    @foreach ($eventList as $eventL)
                    <div class="mid-column border-bottom">
                        <table class="first-table">
                            <tbody>
                                <tr>
                                    <td width="52px">
                                        <img class="image-icon" src="/storage/event-picture/{{ $eventL->event->picture }}"  alt="event-picture">
                                    </td>
                                    <td class="name-table">
                                        <h7>
                                            {{ $eventL->event->name }}
                                        </h7>
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
                        @if($actors->count() > 10)
                        <a style="text-decoration: none; float: right; " href="">View More</a>
                        @endif
                        <div style="clear: both;"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($actors->count())
                @foreach ($actors as $actor)
                <div class="mid-column">
                    <table class="first-table">
                        <tbody>
                            <tr>
                                <td width="52px">
                                    <img class="image-icon" src="/storage/person-picture/{{ $actor->person->picture }}"  alt="person-picture">
                                </td>
                                <td class="name-table">
                                    <h7>
                                        {{ Str::words($actor->person->name, 2, '') }}
                                    </h7>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endforeach
                {{-- Jika data tidak ada --}}
                @else
                <div class="col">
                    <p class="text-center fs-4">This Characters Doesn't Have Actor</p>
                </div>
                @endif
            </div> <!--// close of Data Actor div //-->
        </div> <!--// close of Main Side div //-->
    </div>
</div>

@endsection