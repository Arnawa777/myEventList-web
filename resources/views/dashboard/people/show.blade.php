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
                <div class="parent-cover-event">
                    @if($person->picture)
                    <img class="cover-event" src="/storage/person-picture/{{ $person->picture }}" alt="person-img">
                    @else
                        <img class="cover-event-empty" src="/img/No_image_available.svg" alt="no-img">
                    @endif
                </div>
                <div class="border-bottom" style="margin-bottom:10px;">
                    <h5>Information</h5>
                </div>
                <div>
                    <p> Birthday: 
                        @if ($person->birthday)
                            {{ date('d M Y', strtotime($person->birthday)) }}
                        @else
                            Unknown
                        @endif
                    </p>
                    <p> Biography : </p>
                    @if ($person->biography)
                        <article>
                            {!! $person->biography !!}
                        </article>
                    @else
                        This Person Doesn't have biography
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
                        <h5 style="float: left;">Actor Roles</h5>
                        <div style="clear: both;"></div>
                    </div>
                </div>
            
                <div class="col-12">
                    @if ($actors->count())
                    @foreach ($actors as $actor)
                        @foreach ($actor->actor_event as $ac)
                            <div class="first-table" style="text-align:left; float: left;">
                                <div style="display: inline-block;">
                                    @if ($actor->character->picture)
                                        <img class="image-icon" src="/storage/character-picture/{{ $actor->character->picture }}"  alt="character-picture">
                                    @else
                                        <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                    @endif
                                </div>
                                <div class="name-table" style="display: inline-block;">
                                    <h5>
                                        {{ $actor->character->name }}
                                    </h5>
                                    <p>
                                        {{ $actor->character->role }}
                                    </p>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="first-table" style="text-align:right; float: right;">
                                <div class="name-table" style="display: inline-block; margin-right:0;">
                                    <h5>{{ $ac->event->name }}</h5> 
                                </div>
                                <div style="display: inline-block;">
                                    @if ($ac->event->picture)
                                        <img class="image-icon" src="/storage/event-picture/{{ $ac->event->picture }}"  alt="event-picture">
                                    @else
                                        <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                    @endif
                                </div>
                            </div>
                            <div class="clear"></div>
                        @endforeach
                    @endforeach

                    {{-- Jika data tidak ada --}}
                    @else
                    <div class="col">
                        <p> This Person Doesn't Have Actor Role</p>
                    </div>
                    @endif
                </div> <!--// close of Data person div //-->
            </div> <!--// close of Staff div //-->

            {{-- Staff --}}
            <div class="row" id="main-row">
                <div class="col-12"> 
                    <div class="border-bottom" style="margin-bottom:10px;">
                        <h5 style="float: left;">Staff Roles</h5>
                        <div style="clear: both;"></div>
                    </div>
                </div>
            
                
                @forelse ($staff as $stf) 
                <div class="row" style="background: white; margin: 10px; max-width:845px;">
                    <div class="col-1" style="padding-left: 0; margin-left:0px;">
                        @if ($stf->event->picture)
                            <img class="image-icon" src="/storage/event-picture/{{ $stf->event->picture }}"  alt="event-picture">
                        @else
                            <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                        @endif
                    </div>
                    <div class="col-11 name-table" style="padding-left:5px">
                        <h5>
                            {{ $stf->event->name }}
                        </h5>
                        <h6 style="padding-bottom:10px; font-style:italic; font-weight:350">
                            {{ $stf->role }}
                        </h6>
                        <h6 style="font-size:16px; font-weight:400;">
                            @if ($stf->description)
                            {{-- {!!  Str::limit($stf->description, 50, $end='...')  !!} --}}
                            
                                {!!  $stf->description !!}
                                @else
                                This role doesn't have description yet...
                                @endif 
                        </h6> 
                    </div>
                </div> <!--// close of Data person div //-->
                @empty
                    <p>This Person Doesn't Have Staff Role</p>
                @endforelse 
            </div> <!--// close of Staff div //-->
        </div>

    </div>
</div>



@endsection