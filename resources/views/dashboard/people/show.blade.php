{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<link rel="stylesheet" href="{{ URL::to('/') }}/css/events.css">

<div class="col-lg-9 my-4" id="land-event">
    <div class="row" style="padding: 0px 10px">
        <div class="col-md-12" id="title">
            <h3>{{ $person->name }}</h3>
        </div>

        {{-- Button --}}
        <div style="padding-bottom: 10px">
            <a href="/dashboard/people"
            class="btn btn-info border-0">
            <span data-feather="arrow-left"></span> Back to List Person
        </a>
        <a href="/dashboard/people/{{ $person->slug }}/edit"
            class="btn btn-warning border-0">
            <span data-feather="edit"></span> Edit
        </a>
        <form action="/dashboard/people/{{ $person->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">  
            <span data-feather="x-circle"></span> Delete</button>
            </form>
        </div>

        {{-- Left Side --}}
        <div class="col-sm-3">
            <div class="row" id="main-row">
                <div style="margin-bottom:20px;">
                    <img class="cover-event" src="/storage/person-picture/{{ $person->picture }}" >
                </div>
                <div class="border-bottom" style="margin-bottom:10px;">
                    <h5 style="float: left;">Event</h5>
                    <div style="clear: both;"></div>
                </div>

                <div>
                    @if ($eventList->count())
                    @foreach ($eventList as $eventL)
                    <div class="mid-column border-bottom">
                        <table class="first-table">
                            <tbody>
                                <tr>
                                    <td width="52px">
                                        <img class="image-icon" src="/storage/event-picture/{{ $eventL->event->picture }}"  alt="person-picture">
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
                        <p>This Person Doesn't Have Event</p>
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
    
            {{-- Biography --}}
            <div class="row" id="main-row">
              <div class="col-12"> 
                <div class="border-bottom" style="margin-bottom:10px;">
                    <h5>Biography</h5>
                </div>
                @if (is_null($person->biography))
                    <p> This Person doesn't have biography yet... </p>
                @else
                    <article>
                        {!! $person->biography !!}
                    </article>
                @endif
              </div>
            </div>
            
            {{-- Person --}}
            <div class="row" id="main-row">
                <div class="col-12"> 
                    <div class="border-bottom" style="margin-bottom:10px;">
                        <h5 style="float: left;">Actor Roles</h5>
                        @if($actors->count() > 10)
                        <a style="text-decoration: none; float: right; " href="">View More</a>
                        @endif
                        <div style="clear: both;"></div>
                    </div>
                </div>
            
                <div class="row">
                    @if ($actors->count())
                    @foreach ($actors as $actor)
                        @foreach ($actor->actor_event as $ac)
                        <div class="left-column" style="width: 50%">
                            <table class="first-table">
                                <tbody>
                                    <tr>
                                        <td width="52px">
                                            <img class="image-icon" src="/storage/character-picture/{{ $actor->character->picture }}"  alt="character-picture">
                                        </td>
                                        <td class="name-table">
                                            <h5>
                                                {{ $actor->character->name }}
                                            </h5>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="right-column" style="width: 50%">
                            <table class="first-table">
                                <tbody>
                                    <tr>
                                        <td align="right" class="name-table">
                                            <h5>{{ $ac->event->name }}</h5> 
                                        </td>
                                        <td width="52px">
                                            <img class="image-icon" src="/storage/event-picture/{{ $ac->event->picture }}"  alt="event-picture">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                        @endforeach
                    @endforeach

                    {{-- Jika data tidak ada --}}
                    @else
                    <div class="col">
                        <p class="text-center fs-4">This Person Doesn't Have Actor Role</p>
                    </div>
                    @endif
                </div> <!--// close of Data person div //-->
            </div> <!--// close of Staff div //-->

            {{-- Staff --}}
            <div class="row" id="main-row">
                <div class="col-12"> 
                    <div class="border-bottom" style="margin-bottom:10px;">
                        <h5 style="float: left;">Actor Roles</h5>
                        @if($staff->count() > 10)
                        <a style="text-decoration: none; float: right; " href="">View More</a>
                        @endif
                        <div style="clear: both;"></div>
                    </div>
                </div>
            
                <div class="row">
                    @if ($staff->count())
                    @foreach ($staff as $stf)
                    <div class="mid-column">
                        <table class="first-table">
                            <tbody>
                                <tr>
                                    <td width="52px">
                                        <img class="image-icon" src="/storage/event-picture/{{ $stf->event->picture }}"  alt="event-picture">
                                    </td>
                                    <td class="name-table">
                                        <h5>
                                            {{ $stf->event->name }}
                                        </h5>
                                        <p>{{ $stf->name }} </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endforeach

                    {{-- Jika data tidak ada --}}
                    @else
                    <div class="col">
                        <p class="text-center fs-4">This Person Doesn't Have Actor Role</p>
                    </div>
                    @endif
                </div> <!--// close of Data person div //-->
            </div> <!--// close of Staff div //-->
        </div>

    </div>
</div>



@endsection