{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
<link rel="stylesheet" href="{{ URL::to('/') }}/css/events.css">
{{-- {{ dd($allReviews) }} --}}
<style>
    #horiznav_nav ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333333;
    }
    
    #horiznav_nav li {
      float: left;
    }
    
    #horiznav_nav li a {
      display: block;
      color: white;
      text-align: center;
      padding: 16px;
      text-decoration: none;
    }
    
    #horiznav_nav li a:hover {
      background-color: #111111;
    }
</style>

<div class="container">
        <div class="row" id="land-event">
            <div class="col-sm-12" id="title">
                <h3>{{ $event->name }}</h3>
            </div>
            {{-- Left Side --}}
            <div class="col-sm-3">
                <div class="row" id="main-row">
                    <div style="margin-bottom:20px;" id="event_id" data-field-id="{{ $event->id }}">
                        <img class="cover-event" src="/storage/event-picture/{{ $event->picture }}" >
                    </div>
                    <div class="border-bottom" style="margin-bottom:10px;">
                        <h5>Information</h5>
                    </div>
                    <div>
                        <p> Category:  {{ $event->category->name }} </p>
                        <p> Established: {{ date('d M Y', strtotime($event->date)) }}</p>
                        <p> Location: {{ $event->location->regency }}</p>
                    </div>
                    <div>
                        @auth
                        <form action="{{ route('favorites.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="event_id" value={{ $event->id }}>
                            
                            @if($favorite)
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-heart"></i> Favorited
                            @else
                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                            <i class="far fa-heart"></i> Add to Favorite
                            @endif
                            </button>
                          </form>
                        @endauth
                    </div>
                    
                </div>
            </div> <!--// close of Left Side div //-->

            {{-- Main Side --}}
            <div class="col-sm-9">
                <div id="horiznav_nav" style="margin: 5px 0 10px 0;">
                    <ul style="margin-right: 0; padding-right: 0;">
                          <li><a href="/events/{{ $event->slug }}">Details</a>
                      </li>
                          <li><a href="/events/{{ $event->slug }}/characters">Characters &amp; Staff</a>
                      </li>
                          <li><a href="/events/{{ $event->slug }}/reviews">Reviews</a>
                      </li>
                      </ul>
                      <div style="clear: left;"></div>
                </div>
                

                {{-- Character & Actor --}}
                <div class="row" id="main-row">
                    <div class="col-12"> 
                        <div class="border-bottom" style="margin-bottom:10px;">
                            <h5 style="float: left;">Character & Actor</h5>
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
                                            <img src="/storage/character-picture/{{ $ac->character->picture }}"  alt="person-picture">
                                        </td>
                                        <td>
                                            <h7 class="name-table">
                                                {{ Str::words($ac->character->name, 2, '') }}
                                            </h7>
                                            <p class="name-table">{{ $ac->character->role }}</p>
                                        </td>
                                        <td align="right">
                                            <h7 class="name-table">
                                                {{ Str::words($ac->person->name, 2, '') }}
                                            </h7>
                                            <p>Played</p>
                                        </td>
                                        <td width="52px">
                                            <img src="/storage/person-picture/{{ $ac->person->picture }}"  alt="person-picture">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @empty
                            <p>No Character & Actor have been added for this event.</p>
                        @endforelse
                    </div> <!--// close of Data Chara div //-->
                </div> <!--// close of Chara & person div //-->

                {{-- Staff --}}
                <div class="row" id="main-row">
                    <div class="col-12" id="staff"> 
                        <div class="border-bottom" style="margin-bottom:10px;">
                            <h5 style="float: left;">Staff</h5>
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
                                                <img src="/storage/person-picture/{{ $stf->person->picture }}"  alt="person-picture">
                                            </td>
                                            <td>
                                                <h7 class="name-table">
                                                    {{ Str::words($stf->person->name, 2, '') }}
                                                </h7>
                                                <p class="name-table">{{ $stf->role }}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @empty
                            <p>No Staff have been added for this event.</p>
                        @endforelse
                    </div> <!--// close of Data Chara div //-->
                </div> <!--// close of Staff div //-->

            
            </div> <!--// close of Main Side div //-->
        </div>
</div>

@endsection