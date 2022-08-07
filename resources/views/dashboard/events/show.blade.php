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
            <span data-feather="arrow-left"></span> Back to List Event
        </a>
        <a href="/dashboard/events/{{ $event->slug }}/edit"
            class="btn btn-warning border-0">
            <span data-feather="edit"></span> Edit
        </a>
        <form action="/dashboard/events/{{ $event->slug }}" method="post" class="d-inline">
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
                    <img class="cover-event" src="/storage/event-picture/{{ $event->picture }}" >
                </div>
                <div class="border-bottom" style="margin-bottom:10px;">
                    <h5>Information</h5>
                </div>
                <div>
                    <p> Category:  {{ $event->category->name }} </p>
                    <p> Established: {{ date('d M Y', strtotime($event->date)) }}</p>
                    <p> Location: {{ $event->location->sub_regency }}, {{ $event->location->regency }}</p>
                </div>
            </div>
        </div> <!--// close of Left Side div //-->

        {{-- Main Side --}}
        <div class="col-sm-9">
            {{-- Rating & Video --}}
            <div class="row" id="main-row">
                <div class="col-6 col-sm-6">
                    <p>Rating</p>
                    <p><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></p>
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

            {{-- Character & Person --}}
            <div class="row" id="main-row">
                <div class="col-12"> 
                    <div class="border-bottom" style="margin-bottom:10px;">
                        <h5 style="float: left;">Character & Actor</h5>
                        @if($actors->count() > 10)
                        <a style="text-decoration: none; float: right; " href="">View More</a>
                        @endif
                        <div style="clear: both;"></div>
                    </div>
                </div>
            
                <div class="row">
                    @if ($actors->count())
                    {{-- @foreach ($actors->take(1) as $ac) --}}
                    @foreach ($actors->collapse() as $ac)
                    <div class="left-column">
                        <table class="first-table">
                            <tbody>
                                <tr>
                                    <td width="52px">
                                        <img src="/storage/character-picture/{{ $ac->character->picture }}"  alt="person-picture">
                                    </td>
                                    <td>
                                        <h7 class="name-table">
                                            {{ Str::words($ac->character->name, 2, '') }}
                                        </h7>
                                        <p>Something</p>
                                    </td>
                                    <td align="right">
                                        <h7 class="name-table">
                                            {{ Str::words($ac->person->name, 2, '') }}
                                        </h7>
                                        <p>Something</p>
                                    </td>
                                    <td width="52px">
                                        <img src="/storage/person-picture/{{ $ac->person->picture }}"  alt="person-picture">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endforeach
                    {{-- @foreach ($event->actor->skip(1) as $ac) --}}
                    @foreach ($actors as $ac)
                    <div class="right-column">
                        <table class="first-table">
                            <tbody>
                                <tr>
                                    <td width="52px">
                                        <img src="/storage/character-picture/{{ $ac->character->picture }}"  alt="person-picture">
                                    </td>
                                    <td>
                                        <h7 class="name-table">
                                            {{ Str::words($ac->character->name, 2, '') }}
                                        </h7>
                                        <p>Something</p>
                                    </td>
                                    <td align="right">
                                        <h7 class="name-table">
                                            {{ Str::words($ac->person->name, 2, '') }}
                                        </h7>
                                        <p>Something</p>
                                    </td>
                                    <td width="52px">
                                        <img src="/storage/person-picture/{{ $ac->person->picture }}"  alt="person-picture">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>       
                    @endforeach

                    {{-- Jika data tidak ada --}}
                    @else
                    <div class="col">
                        <p class="text-center fs-4">This Event Doesn't Have Character</p>
                    </div>
                    @endif
                </div> <!--// close of Data Chara div //-->
            </div> <!--// close of Chara & person div //-->

            {{-- Staff --}}
            <div class="row" id="main-row">
                <div class="col-12"> 
                    <div class="border-bottom" style="margin-bottom:10px;">
                        <h5 style="float: left;">Staff</h5>
                        @if($staff->count() > 10)
                        <a style="text-decoration: none; float: right; " href="">View More</a>
                        @endif
                        <div style="clear: both;"></div>
                    </div>
                </div>
            
                <div class="row">
                    @if ($staff->count())
                    {{-- @foreach ($staff->take(1) as $stf) --}}
                    @foreach ($staff as $stf)
                    <div class="left-column">
                        <table class="first-table">
                            <tbody>
                                <tr>
                                    <td width="52px">
                                        <img src="/storage/person-picture/{{ $stf->person->picture }}"  alt="person-picture">
                                    </td>
                                    <td>
                                        <h7 class="name-table">
                                            {{ Str::words($stf->person->name, 2, '') }}
                                        </h7>
                                        <p>Something</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endforeach

                    {{-- Jika data tidak ada --}}
                    @else
                    <div class="col">
                        <p class="text-center fs-4">This Event Doesn't Have Staff</p>
                    </div>
                    @endif
                </div> <!--// close of Data Chara div //-->
            </div> <!--// close of Staff div //-->

            {{-- Review --}}
            <div class="row" id="main-row">
                <div class="col-12"> 
                  <div class="border-bottom" style="margin-bottom:10px;">
                      <h5>Review</h5>
                  </div>
                  {{-- @if (is_null($event->synopsis))
                      <p> This Event doesn't have synopsis yet... </p>
                  @else
                      <article>
                          {!! $event->synopsis !!}
                      </article>
                  @endif --}}
                </div>
              </div> 
           
        </div> <!--// close of Main Side div //-->
    </div>
</div>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}

<script type="text/javascript">
//     if (document.getElementById('inline') !=null) 
//      console.log('it exists!');

//    if (document.getElementById('inline') ==null) 
//      console.log('does not exist!');

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
    // document.querySelector('#myModal').on('hidden.bs.modal', function () {
        
    // });
    close.onclick = function(){
        setTimeout(function(){
            document.querySelector("#myModal iframe").setAttribute("src", null);
        }, 100);
        btn.classList.remove("active");
        clip.classList.remove("active");
        
    }
   
    // document.getElementById("myModal").on('show.bs.modal', function () {
    //     document.querySelectorAll("#myModal iframe").attr("src", videoSrc+"?autoplay=1");
    //     // btn.classList.add("active");
    //     // clip.classList.add("active");
    // })

    // $('#myModal').on('show.bs.modal', function () { // on opening the modal
        
    //     // set the video to autostart
    //     $("#myModal iframe").attr("src", videoSrc+"?autoplay=1");
    //     // btn.classList.add("active");
    //     // clip.classList.add("active");
        
    // }).on('hidden.bs.modal', function (e) { // on closing the modal
    //     // stop the video
    //     $("#myModal iframe").attr("src", null);
    //     btn.classList.remove("active");
    //     clip.classList.remove("active");
    // });

    </script>


@endsection