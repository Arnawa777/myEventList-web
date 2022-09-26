{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
<link rel="stylesheet" href="{{ URL::to('/') }}/css/events.css">
{{-- {{ dd($allReviews) }} --}}

<div class="container">
        <div class="row" id="land-event">
            <div class="col-sm-12" id="title" style="background: #333333; color:white">
                <h3>{{ $event->name }}</h3>
            </div>
            {{-- Left Side --}}
            <div class="col-sm-3" style="background: #333333; color:white;">
                <div class="row" id="main-row">
                    <div class="parent-cover-event" style="margin-top: 10px;" id="event_id" data-field-id="{{ $event->id }}">
                        @if ($event->picture)
                            <img class="cover-event" src="/storage/event-picture/{{ $event->picture }}" alt="event-img">
                        @else
                            <img class="cover-event-empty" src="/img/No_image_available.svg" alt="no-img">
                        @endif
                    </div>
                    <div class="border-bottom" style="margin-bottom:10px;">
                        <h5>Information</h5>
                    </div>
                    <div>
                        <p> Category:  {{ $event->category->name }} </p>
                        <p> Established: {{ date('d M Y', strtotime($event->date)) }}</p>
                        <p> Location: {{ $event->location->sub_regency }}, {{ $event->location->regency }}</p>
                    </div>
                    <div>
                        @auth
                        <form action="{{ route('favorites.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="event_id" value={{ $event->id }}>
                            
                            @if($favorite)
                            <button type="submit" class="btn btn-sm" style="color: rgb(253, 53, 53); border: 2px rgb(253, 53, 53) solid">
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
                <div id="horiznav_nav" style="margin: 0 0 10px 0;">
                    <ul style="margin-right: 0; padding-right: 0;">
                          <li><a href="/events/{{ $event->slug }}">Details</a>
                      </li>
                          <li><a href="/events/{{ $event->slug }}/characters">Characters &amp; Staff</a>
                      </li>
                          <li><a href="/events/{{ $event->slug }}/reviews">Reviews</a>
                      </li>
                    </ul>
                </div>
                {{-- Rating & Video --}}
                <div class="row" id="main-row">
                    <div class="col-3 col-sm-3">
                        <div class="card" style="height: 200px; width:100%">
                            <div class="card-body" style="text-align:center;">
                                <h2 class="card-title">Score</h2>
                                <h2 class="numberCircle">
                                    {{-- 4 digit --}}
                                    {{ substr($totalRating, 0, 4) }}
                                    {{-- {{$event->reviews->sum('rating')}} --}}
                                </h2>
                              <p>From {{ $userReview }} User</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-sm-3">
                        <div class="card" style="height: 200px; width:100%">
                            <div class="card-body" style="text-align:center;">
                              <h2 class="card-title">Favorited</h2>
                                @if ($event->favorites->count() >= 1000)
                                    <h2 class="favCircleMany">
                                        {{ $event->favorites->count() }} <i class="fas fa-heart"></i>
                                    </h2>
                                @else
                                    <h2 class="favCircle">
                                        {{ $event->favorites->count() }} <i class="fas fa-heart"></i>
                                    </h2>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 float-end text-end">
                        @if (is_null($event->video))
                        <img class="cover-video" src="{{ URL::to('/') }}/img/no-video.jpg" alt="Video not found">
                        @else
                            <a href="#myModal" data-toggle="modal">
                            <div id="coverVideo">
                                <img class="cover-video" src="http://img.youtube.com/vi/{{ $event->video }}/mqdefault.jpg"alt="cover">
                                <img src="{{ URL::to('/') }}/icon/play-button.png" class="thumb">
                            </div>
                            </a>
                            {{-- Modal --}}
                            {{-- Video Popup --}}
                            <div id="myModal" class="modal">
                                <iframe 
                                src="https://www.youtube.com/embed/{{ $event->video }}" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                                <img src="{{ URL::to('/') }}/icon/x-square.svg" class="close" alt="icon-close">  
                            </div> 
                        @endif
                            
                    </div>
                    
                </div> <!--// close of Rating & Video div //-->
        
                {{-- Synopsis --}}
                <div class="row" id="main-row">
                    <div class="col-12"> 
                        <div class="border-bottom" style="margin-bottom:10px;">
                            <h5>Synopsis</h5>
                        </div>
                        @if (is_null($event->synopsis))
                            <p> This Event doesn't have synopsis yet... </p>
                        @else
                            <article>
                                {!! $event->synopsis !!}
                            </article>
                        @endif
                    </div>
                </div> 

                {{-- Character & Actor --}}
                <div class="row" id="main-row">
                    <div class="col-12"> 
                        <div class="border-bottom" style="margin-bottom:10px;">
                            <h5 style="float: left;">Character & Actor</h5>
                            @if($actors->count())
                            <a style="text-decoration: none; float: right; " href="/events/{{ $event->slug }}/characters">View More</a>
                            @endif
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                
                    <div class="col-12">
                        @forelse ($actors as $ac)
                            <table class="first-table"  style="text-align:left; float: left;">
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
                                            <p class="name-table">{{ $ac->character->role }}</p>
                                        </td>
                                        <td align="right">
                                            <a href="/people/{{ $ac->person->slug }}">
                                                <h7 class="name-table">
                                                    {{ Str::words($ac->person->name, 2, '') }}
                                                </h7>
                                            </a>
                                            <p class="name-table">Actor</p>
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
                        @empty
                            <p>No Character & Actor have been added for this event.</p>
                        @endforelse
                       
                    </div> <!--// close of Data Chara div //-->
                </div> <!--// close of Chara & person div //-->
            
                {{-- Staff --}}
                <div class="row" id="main-row">
                    <div class="col-12"> 
                        <div class="border-bottom" style="margin-bottom:10px;">
                            <h5 style="float: left;">Staff</h5>
                            @if($staff->count())
                            <a style="text-decoration: none; float: right;" href="/events/{{ $event->slug }}/characters#staff">View More</a>
                            @endif
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                
                    <div class="col-12">
                            @forelse ($staff as $stf)
                                <table class="first-table" style="text-align:left; float: left;">
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
                            @empty
                                <p>No Staff have been added for this event.</p>
                            @endforelse
                    </div> <!--// close of Data Chara div //-->
                </div> <!--// close of Staff div //-->

                {{-- Review --}}
                <div class="row" id="main-row">
                    <div class="col-12"> 
                        <div class="border-bottom" style="margin-bottom:10px;">
                            <h5 style="float: left;">Review</h5>
                            @if($allReviews->count())
                            <a style="text-decoration: none; float: right;" href="/events/{{ $event->slug }}/reviews">View More</a>
                            @endif
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                    <div class="col-12"> 
                        @forelse ($allReviews as $rev)
                        <div class="card" style="min-height: 200px; width:100%; margin:10px 0px;">
                            <div class="row no-gutters">
                                <div class="col-1" style="padding-right: 0px; margin-right:0px;">
                                    <a href="/profile/{{ $rev->user->username }}">
                                        @if ($rev->user->picture)
                                            <img class="review-img" src="/storage/user-picture/{{ $rev->user->picture }}" class="img-fluid" alt="user-picture">
                                        @else
                                            <img class="review-img-empty" src="/img/No_image_available.svg" alt="no-img">
                                        @endif
                                    </a>
                                </div>
                                <div class="col-11">
                                    <div class="card-block" style="min-height: 200px">
                                        <a href="/profile/{{ $rev->user->username }}">
                                            <h4 class="card-title">{{ $rev->user->username }}</h4>
                                        </a>

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
                        @empty
                            <p>No reviews have been submitted for this event. Be the first to make a review</p>
                        @endforelse
                    </div>
                </div>

                {{-- My Review --}}
                @auth
                    @if ($myReview)
                    <div class="row" id="main-row">
                        <div class="col-12"> 
                            <div class="border-bottom" style="margin-bottom:10px;">
                                <h5 style="float: left;">Your Review</h5>
                                <div style="clear: both;"></div>
                            </div>
                        </div>
                        <div class="col-12" id="showreview-{{ $myReview->id }}"> 
                            <div class="card" style="position: relative; min-height: 200px; width:100%; margin:10px 0px; padding-bottom:20px">
                                <div class="card-body">
                                <h3 class="card-title">{{ $myReview->user->username }}</h3>
                                @if ($myReview->rating >=8)
                                    <p style="color: blue">Reviewer Rating: {{ $myReview->rating }}</p>
                                @elseif($rev->rating <=7 && $rev->rating >=4 )
                                    <p style="color: rgba(208, 196, 23, 0.967)">Reviewer Rating: {{ $myReview->rating }}</p>
                                @else
                                    <p style="color: red">Reviewer Rating: {{ $myReview->rating }}</p>
                                @endif
                                <p>{!! $myReview->body !!}</p>
                                <div class="footer-action">
                                    <button type="button" class="showedit" data-id="{{ $myReview->id }}" id="btn-action"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                                   
                                    <form method="post" action="/events/{{ $event->slug }}/review/{{ $myReview->id }}" enctype="multipart/form-data" class="d-inline">
                                    @method('delete')
                                    @csrf
                                        {{-- yang penting kan jalan --}}
                                        <input type="hidden" name="my_review_id" value="{{ $myReview->id }}">
                                        <button type="submit" onclick="return confirm('Are you sure?')" id="btn-action"><i class="fa-solid fa-trash"></i> Delete</button>
                                    </form>
                                </div>
                                {{-- <p class="card-text" style="padding-left:20px">{!! $rev->body !!}</p> --}}
                                </div>
                            </div>
                        </div>

                        {{-- Hide Edit --}}
                        <div class="col-12" style="display:none; background-color: white; border:1px rgb(198, 198, 198) solid;" id="editreview-{{ $myReview->id }}">
                            <form method="post" action="/events/{{ $event->slug }}/review/{{ $myReview->id }}" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            {{-- Rating --}}
                            <div class="mb-3" style="margin-top: 10px">
                                <select class="form-select" name="rating" value="{{ old('rating', $myReview->rating )}}">
                                    @if (old('rating', $myReview->rating))
                                        <option {{ old('rating', $myReview->rating) == 10 ? 'selected' : '' }}  value="10">(10) Masterpiece</option>
                                        <option {{ old('rating', $myReview->rating) == 9 ? 'selected' : '' }}  value="9">(09) Great</option>
                                        <option {{ old('rating', $myReview->rating) == 8 ? 'selected' : '' }}  value="8">(08) Very Good</option>
                                        <option {{ old('rating', $myReview->rating) == 7 ? 'selected' : '' }} value="7">(07) Good</option>
                                        <option {{ old('rating', $myReview->rating) == 6 ? 'selected' : '' }}  value="6">(06) Fine</option>
                                        <option {{ old('rating', $myReview->rating) == 5 ? 'selected' : '' }}  value="5">(05) Average</option>
                                        <option {{ old('rating', $myReview->rating) == 4 ? 'selected' : '' }}  value="4">(04) Bad</option>
                                        <option {{ old('rating', $myReview->rating) == 3 ? 'selected' : '' }}  value="3">(03) Very Bad</option>
                                        <option {{ old('rating', $myReview->rating) == 2 ? 'selected' : '' }}  value="2">(02) Horrible</option>
                                        <option {{ old('rating', $myReview->rating) == 1 ? 'selected' : '' }}  value="1">(01) Appalling</option>
                                    @else
                                        <option value="10">(10) Masterpiece</option>
                                        <option value="9">(09) Great</option>
                                        <option value="8">(08) Very Good</option>
                                        <option value="7">(07) Good</option>
                                        <option value="6">(06) Fine</option>
                                        <option value="5">(05) Average</option>
                                        <option value="4">(04) Bad</option>
                                        <option value="3">(03) Very Bad</option>
                                        <option value="2">(02) Horrible</option>
                                        <option value="1">(01) Appalling</option>
                                    @endif
                                </select>
                                
                            </div>

                            {{-- TRIX body --}}
                            <div class="replyBox">
                                <input id="body" type="hidden" name="body" value="{{ old('body', $myReview->body) }}">
                                <trix-editor input="body"></trix-editor>
                                @error('body')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- Pass Event Id --}}
                            <div>
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                <input type="hidden" name="review_id" value="{{ $myReview->id }}">
                            </div>
                            <div class="footer-button">
                                <button type="submit" id="btn-edit"><i class="fa-regular fa-floppy-disk"></i> Save</button>
                                <button type="button" id="btn-cancel" class="canceledit" class="canceledit" data-id="{{ $myReview->id }}">Cancel</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    @else
                    
                        <div class="col-12"> 
                            <div class="border-bottom" style="margin-bottom:10px;">
                                <h5 style="float: left;">Post Your Review</h5>
                                <div style="clear: both;"></div>
                            </div>
                        </div>
                        <div style="background-color: white; border:1px rgb(198, 198, 198) solid;">
                            <form method="post" action="/events/{{ $event->slug }}/review" enctype="multipart/form-data">
                            @csrf
                            {{-- Rating --}}
                            <div style="margin: 10px">
                                <select class="form-select" name="rating" value="{{ old('rating') }}">
                                    @if (old('rating'))
                                        <option {{ old('rating') == 10 ? 'selected' : '' }}  value="10">(10) Masterpiece</option>
                                        <option {{ old('rating') == 9 ? 'selected' : '' }}  value="9">(09) Great</option>
                                        <option {{ old('rating') == 8 ? 'selected' : '' }}  value="8">(08) Very Good</option>
                                        <option {{ old('rating') == 7 ? 'selected' : '' }} value="7">(07) Good</option>
                                        <option {{ old('rating') == 6 ? 'selected' : '' }}  value="6">(06) Fine</option>
                                        <option {{ old('rating') == 5 ? 'selected' : '' }}  value="5">(05) Average</option>
                                        <option {{ old('rating') == 4 ? 'selected' : '' }}  value="4">(04) Bad</option>
                                        <option {{ old('rating') == 3 ? 'selected' : '' }}  value="3">(03) Very Bad</option>
                                        <option {{ old('rating') == 2 ? 'selected' : '' }}  value="2">(02) Horrible</option>
                                        <option {{ old('rating') == 1 ? 'selected' : '' }}  value="1">(01) Appalling</option>
                                    @else
                                        <option value="10">(10) Masterpiece</option>
                                        <option value="9">(09) Great</option>
                                        <option value="8">(08) Very Good</option>
                                        <option value="7">(07) Good</option>
                                        <option value="6">(06) Fine</option>
                                        <option value="5">(05) Average</option>
                                        <option value="4">(04) Bad</option>
                                        <option value="3">(03) Very Bad</option>
                                        <option value="2">(02) Horrible</option>
                                        <option value="1">(01) Appalling</option>
                                    @endif
                                </select>
                            </div>

                            {{-- TRIX body --}}
                            <div class="replyBox" style="margin: 10px">
                                <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                                <trix-editor input="body"></trix-editor>
                                @error('body')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            {{-- Pass Event Id --}}
                            <div>
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                            </div>
                            <div class="footer-submit-right">
                                <button type="submit" id="btn-reply"><i class="fa-regular fa-pen-to-square"></i> Submit</button>
                            </div>
                            
                            </form>
                        </div>
                    @endif
                @endauth

            
            </div> <!--// close of Main Side div //-->
        </div>
</div>

<script>
    $(document).ready(function(){
        // change the selector to use a class
        $(".showedit").click(function(){
            // this will query for the clicked toggle
            var $toggle = $(this); 

            // build the target form id
            var showid = "#showreview-" + $toggle.data('id'); 
            var editid = "#editreview-" + $toggle.data('id'); 

            $( showid ).hide();
            $( editid ).show();
        });
        $(".canceledit").click(function(){
            // this will query for the clicked toggle
            var $toggle = $(this); 

            // build the target form id
            var showid = "#showreview-" + $toggle.data('id'); 
            var editid = "#editreview-" + $toggle.data('id'); 

            $( showid ).show();
            $( editid ).hide();
        });
    });
</script>

<script type="text/javascript">
    // Get the clip
    let btn = document.querySelector("#coverVideo");
    let clip = document.querySelector(".modal");
    let close = document.querySelector(".close");

    // var videoSrc = $("#myModal iframe").attr("src");
    let videoSrc = document.querySelector("#myModal iframe").getAttribute("src");
    
    btn.onclick = function(){
        setTimeout(function(){
            btn.classList.add("active");
            clip.classList.add("active");
        }, 600);
        
        document.querySelector("#myModal iframe").setAttribute("src", videoSrc+"?autoplay=1");
        
      }

    close.onclick = function(){
        setTimeout(function(){
            document.querySelector("#myModal iframe").setAttribute("src", null);
        }, 100);
        btn.classList.remove("active");
        clip.classList.remove("active");  
    }
   

</script>


@endsection