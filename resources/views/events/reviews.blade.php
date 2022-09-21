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
                </div>
                
                {{-- Review --}}
                <div class="row" id="main-row">
                    <div class="col-12"> 
                        <div class="border-bottom" style="margin-bottom:10px;">
                            <h5 style="float: left;">Reviews</h5>
                            <div style="clear: left;"></div>
                        </div>
                    </div>
                    <div class="col-12"> 
                        @forelse ($allReviews as $rev)
                        <div class="card" style="min-height: 200px; width:100%; margin:10px 0px;">
                            <div class="row no-gutters">
                                <div class="col-1" style="padding-right: 0px; margin-right:0px;">
                                    <img style="
                                    max-width: 100%;
                                    height: 84px;
                                    object-fit: cover;" src="/storage/user-picture/{{ $rev->user->picture }}" class="img-fluid" alt="user-picture">
                                </div>
                                <div class="col-11">
                                    <div class="card-block" style="min-height: 200px">
                                        <h4 class="card-title">{{ $rev->user->username }}</h4>
                                        @if ($rev->rating >=8)
                                            <p style="color: blue">Reviewer Rating: {{ $rev->rating }}</p>
                                        @elseif($rev->rating <=7 && $rev->rating >=4 )
                                            <p style="color: rgba(208, 196, 23, 0.967)">Reviewer Rating: {{ $rev->rating }}</p>
                                        @else
                                            <p style="color: red">Reviewer Rating: {{ $rev->rating }}</p>
                                        @endif
                                        
                                        <p class="card-text">{!! $rev->body !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- View Comment --}}
                        
                        
                        @empty
                            <p>No reviews have been submitted for this event. Be the first to make a review</p>
                        @endforelse
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    {{ $allReviews->links('vendor.pagination.custom') }}
                </div>
            
            </div> <!--// close of Main Side div //-->
        </div>
</div>

@endsection