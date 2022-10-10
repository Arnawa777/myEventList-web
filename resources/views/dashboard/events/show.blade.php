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
            <span data-feather="arrow-left"></span> Kembali ke Daftar Komunitas
        </a>
        <a href="/dashboard/events/{{ $event->slug }}/edit"
            class="btn btn-warning border-0">
            <span data-feather="edit"></span>Edit
        </a>
        <form action="/dashboard/events/{{ $event->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-danger" onclick="return confirm('Apa anda yakin?')">  
            <span data-feather="x-circle"></span>Hapus</button>
            </form>
        </div>

        {{-- Left Side --}}
        <div class="col-sm-3">
            <div class="row" id="main-row">
                <div class="parent-cover-event">
                    @if ($event->picture)
                        <img class="cover-event" src="/storage/event-picture/{{ $event->picture }}" alt="event-img">
                    @else
                        <img class="cover-event-empty" src="/img/No_image_available.svg" alt="no-img">
                    @endif
                </div>
                <div class="border-bottom" style="margin-bottom:10px;">
                    <h5>Informasi</h5>
                </div>
                <div>
                    <p> Kategori:  {{ $event->category->name }} </p>
                    @if ($event->date)
                    <p> Berdiri: {{ date('d M Y', strtotime($event->date)) }}</p>
                    @else
                    <p> Berdiri: Tidak diketahui</p>
                    @endif
                    <p> Lokasi: {{ $event->location->sub_regency }}, {{ $event->location->regency }}</p>
                    @if ($event->phone)
                    <p> Ponsel: {{ $event->phone }}</p>
                    @else
                    <p> Ponsel: Tidak diketahui</p>
                    @endif
                </div>
            </div>
        </div> <!--// close of Left Side div //-->

        {{-- Main Side --}}
        <div class="col-sm-9">
            <div id="horiznav_nav" style="margin: 0 0 10px 0;">
                <ul style="margin-right: 0; padding-right: 0;">
                      <li><a href="/dashboard/events/{{ $event->slug }}">Detail</a>
                  </li>
                      <li><a href="/dashboard/events/{{ $event->slug }}/characters">Karakter &amp; Staf</a>
                  </li>
                      <li><a href="/dashboard/events/{{ $event->slug }}/reviews">Ulasan</a>
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
    
            {{-- description --}}
            <div class="row" id="main-row">
              <div class="col-12"> 
                <div class="border-bottom" style="margin-bottom:10px;">
                    <h5>Deskripsi</h5>
                </div>
                @if (is_null($event->description))
                    <p>Komunitas ini belum ada deskripsi..</p>
                @else
                    <article>
                        {!! $event->description !!}
                    </article>
                @endif
              </div>
            </div> 

            {{-- Character & Actor --}}
            <div class="row" id="main-row">
                <div class="col-12"> 
                    <div class="border-bottom" style="margin-bottom:10px;">
                        <h5 style="float: left;">Karakter & Aktor</h5>
                        @if($actors->count())
                        <a style="text-decoration: none; float: right; " href="/dashboard/events/{{ $event->slug }}/characters">Tampil lebih banyak</a>
                        @endif
                        <div style="clear: both;"></div>
                    </div>
                </div>
            
                <div class="col-12">
                    <div class="row">
                        @forelse ($actors as $ac)
                        <table class="first-table">
                            <tbody>
                                <tr>
                                    <td width="52px">
                                        <a href="/dashboard/characters/{{ $ac->character->slug }}">
                                            @if ($ac->character->picture)
                                                <img class="image-icon" src="/storage/character-picture/{{ $ac->character->picture }}"  alt="character-picture">
                                            @else
                                                <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/dashboard/characters/{{ $ac->character->slug }}">
                                            <h7 class="name-table">
                                                {{ Str::words($ac->character->name, 2, '') }}
                                            </h7>
                                        </a>
                                        <p class="name-table">{{ $ac->role }}</p>
                                    </td>
                                    <td align="right">
                                        <a href="/dashboard/people/{{ $ac->person->slug }}">
                                            <h7 class="name-table">
                                                {{ Str::words($ac->person->name, 2, '') }}
                                            </h7>
                                        </a>
                                        <p class="name-table">Aktor</p>
                                    </td>
                                    <td width="52px">
                                        <a href="/dashboard/people/{{ $ac->person->slug }}">
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
                            <p>Belum ada karakter dan aktor yang ditambahkan pada komunitas ini..</p>
                        @endforelse
                    </div>
                </div> <!--// close of Data Chara div //-->
            </div> <!--// close of Chara & person div //-->

            {{-- Staff --}}
            <div class="row" id="main-row">
                <div class="col-12"> 
                    <div class="border-bottom" style="margin-bottom:10px;">
                        <h5 style="float: left;">Staf</h5>
                        @if($staff->count())
                        <a style="text-decoration: none; float: right; " href="/dashboard/events/{{ $event->slug }}/characters#staff">Tampil lebih banyak</a>
                        @endif
                        <div style="clear: both;"></div>
                    </div>
                </div>
            
                <div class="col-12">
                    <div class="row">
                        @forelse ($staff as $stf)
                        <table class="first-table">
                            <tbody>
                                <tr>
                                    <td width="52px">
                                        <a href="/dashboard/people/{{ $stf->person->slug }}">
                                            @if ($stf->person->picture)
                                                <img class="image-icon" src="/storage/person-picture/{{ $stf->person->picture }}"  alt="person-picture">
                                            @else
                                                <img class="image-icon-empty" src="/img/No_image_available.svg" alt="no-img">
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/dashboard/people/{{ $stf->person->slug }}">
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
                            <p>Belum ada staf yang ditambahkan pada komunitas ini</p>
                        @endforelse
                    </div>
                </div> <!--// close of Data Chara div //-->
            </div> <!--// close of Staff div //-->

            {{-- Review --}}
            <div class="row" id="main-row">
                <div class="col-12"> 
                    <div class="border-bottom" style="margin-bottom:10px;">
                        <h5 style="float: left;">Ulasan</h5>
                        @if($allReviews->count())
                        <a style="text-decoration: none; float: right;" href="/dashboard/events/{{ $event->slug }}/reviews">Tampil lebih banyak</a>
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
                                        <p style="float: right; padding-right:10px;">
                                            {{ date('d M Y', strtotime($rev->created_at)) }}
                                        </p>
                                        <div style="clear: left;"></div>
                                        <a href="/profile/{{ $rev->user->username }}">
                                            <h4 class="card-title">{{ $rev->user->username }}</h4>
                                        </a>

                                        @if ($rev->rating >=8)
                                            <p style="color: blue">Skor: {{ $rev->rating }}</p>
                                        @elseif($rev->rating <=7 && $rev->rating >=4 )
                                            <p style="color: rgba(208, 196, 23, 0.967)">Skor {{ $rev->rating }}</p>
                                        @else
                                            <p style="color: red">Skor: {{ $rev->rating }}</p>
                                        @endif
                                        
                                        <p class="card-text">{!! $rev->body !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            <p>Belum ada ulasan yang diberikan pada komunitas ini</p>
                        @endforelse
                </div>
            </div> 
           
        </div> <!--// close of Main Side div //-->
    </div>
</div>

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

    </script>


@endsection