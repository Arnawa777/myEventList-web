{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<link rel="stylesheet" href="{{ URL::to('/') }}/css/events.css">

<div class="col-lg-9 my-3" id="land-event">
    <div class="row" style="padding: 0px 10px">
        <div class="col-md-12" id="title">
            <h3 class="mb-3" >{{ $chara->name }}</h3>
        </div>

        {{-- Button --}}
        <div style="padding-bottom: 10px">
            <a href="/dashboard/characters"
            class="btn btn-info border-0">
            <span data-feather="arrow-left"></span> Back to List Character
        </a>
        <a href="/dashboard/characters/{{ $chara->slug }}/edit"
            class="btn btn-warning border-0">
            <span data-feather="edit"></span> Edit
        </a>
        <form action="/dashboard/characters/{{ $chara->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">  
            <span data-feather="x-circle"></span> Delete</button>
            </form>
        </div>

        {{-- Left Side --}}
        <div class="col-sm-3">
            <div class="row" id="main-row">
                <div class="parent-cover-event">
                    @if($chara->picture)
                        <img class="cover-event" src="/storage/character-picture/{{ $chara->picture }}" >
                    @else
                        <img class="cover-event-empty" src="/img/No_image_available.svg" alt="no-img">
                    @endif
                </div>
                <div class="border-bottom" style="margin-bottom:10px;">
                    <h5 style="float: left;">Event</h5>
                    <div style="clear: both;"></div>
                </div>

                <div>
                    @if ($eventList->count())
                    @foreach ($eventList as $eventL)
                    <div class="mid-column border-bottom">
                        <table class="second-table">
                            <tbody>
                                <tr>
                                    <td width="52px">
                                        <a href="/dashboard/events/{{ $eventL->event->slug }}">
                                            @if ($eventL->event->picture)
                                                <img class="image-icon" src="/storage/event-picture/{{ $eventL->event->picture }}"  alt="event-picture">
                                            @else
                                                <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                            @endif
                                        </a>
                                    </td>
                                    <td class="name-table">
                                        <a href="/dashboard/events/{{ $eventL->event->slug }}">
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
                </div> <!--// close of Data Chara div //-->
            
                <div>
                    {{-- Event --}}
                    <div class="row" id="main-row">
                        
                    </div> <!--// close of Evennt div //-->
                </div>
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
            
            {{-- Person --}}
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
                                            <a href="/dashboard/people/{{ $actor->person->slug }}">
                                                @if ($actor->person->picture)
                                                    <img class="image-icon" src="/storage/person-picture/{{ $actor->person->picture }}"  alt="person-picture">
                                                @else
                                                    <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                                @endif
                                            </a>
                                            
                                        </td>
                                        <td class="name-table">
                                            <a href="/dashboard/people/{{ $actor->person->slug }}">
                                            <h7>
                                                {{ Str::words($actor->person->name, 2, '') }}
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
                        <p>This Characters Doesn't Have Actor</p>
                    @endif
                </div> <!--// close of Data Chara div //-->
            </div> <!--// close of Staff div //-->


    </div>
</div>



@endsection