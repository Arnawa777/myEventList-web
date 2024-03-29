{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
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
                            <img class="cover-event" style="border: 2px white solid;" src="/storage/event-picture/{{ $event->picture }}" alt="event-img">
                        @else
                            <img class="cover-event-empty" style="border: 2px white solid;" src="/img/No_image_available.svg" alt="no-img">
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
                    <div>
                        @auth
                        <form action="{{ route('favorites.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="event_id" value={{ $event->id }}>
                            
                            @if($favorite)
                            <button type="submit" class="btn btn-sm" style="color: rgb(253, 53, 53); border: 2px rgb(253, 53, 53) solid">
                            <i class="fas fa-heart"></i> Favorit
                            @else
                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                            <i class="far fa-heart"></i> Tambah Favorit
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
                          <li><a href="/events/{{ $event->slug }}">Detail</a>
                      </li>
                          <li><a href="/events/{{ $event->slug }}/characters">Karakter &amp; Staf</a>
                      </li>
                          <li><a href="/events/{{ $event->slug }}/reviews">Ulasan</a>
                      </li>
                    </ul>
                </div>
                {{-- Rating & Video --}}
                <div class="row" id="main-row">
                    <div class="col-3 col-sm-3">
                        <div class="card" style="height: 200px; width:100%">
                            <div class="card-body" style="text-align:center;">
                                <h2 class="card-title">Skor</h2>
                                <h2 class="numberCircle">
                                    {{-- 4 digit --}}
                                    {{ substr($totalRating, 0, 4) }}
                                    {{-- {{$event->reviews->sum('rating')}} --}}
                                </h2>
                              <p>Dari {{ $userReview }} User</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 col-sm-3">
                        <div class="card" style="height: 200px; width:100%">
                            <div class="card-body" style="text-align:center;">
                              <h2 class="card-title">Favorit</h2>
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
                            <p> Komunitas ini belum memiliki deskripsi.. </p>
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
                            <a style="text-decoration: none; float: right; " href="/events/{{ $event->slug }}/characters">Tampil lebih banyak</a>
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
                                            <p class="name-table">{{ $ac->role }}</p>
                                        </td>
                                        <td align="right">
                                            <a href="/people/{{ $ac->person->slug }}">
                                                <h7 class="name-table">
                                                    {{ Str::words($ac->person->name, 2, '') }}
                                                </h7>
                                            </a>
                                            <p class="name-table">Aktor</p>
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
                            <p>Belum ada Karakter dan Aktor yang ditambahkan pada Komunitas ini..</p>
                        @endforelse
                       
                    </div> <!--// close of Data Chara div //-->
                </div> <!--// close of Chara & person div //-->
            
                {{-- Staff --}}
                <div class="row" id="main-row">
                    <div class="col-12"> 
                        <div class="border-bottom" style="margin-bottom:10px;">
                            <h5 style="float: left;">Staf</h5>
                            @if($staff->count())
                            <a style="text-decoration: none; float: right;" href="/events/{{ $event->slug }}/characters#staff">Tampil lebih banyak</a>
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
                                <p>Belum ada Staf yang ditambahkan pada Komunitas ini</p>
                            @endforelse
                    </div> <!--// close of Data Chara div //-->
                </div> <!--// close of Staff div //-->

                {{-- Review --}}
                <div class="row" id="main-row">
                    <div class="col-12"> 
                        <div class="border-bottom" style="margin-bottom:10px;">
                            <h5 style="float: left;">Ulasan</h5>
                            @if($allReviews->count())
                            <a style="text-decoration: none; float: right;" href="/events/{{ $event->slug }}/reviews">Tampil lebih banyak</a>
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
                                            <p style="color: rgba(208, 196, 23, 0.967)">Skor: {{ $rev->rating }}</p>
                                        @else
                                            <p style="color: red">Skor: {{ $rev->rating }}</p>
                                        @endif
                                        
                                        <p class="card-text">{!! $rev->body !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            <p>Belum ada ulasan yang diberikan pada Komunitas ini</p>
                        @endforelse
                    </div>
                </div>

                {{-- My Review --}}
                @auth
                    @if ($myReview)
                    <div class="row" id="main-row">
                        <div class="col-12"> 
                            <div class="border-bottom" style="margin-bottom:10px;">
                                <h5 style="float: left;">Ulasan Anda</h5>
                                <div style="clear: both;"></div>
                            </div>
                        </div>
                        <div class="col-12" id="showreview-{{ $myReview->id }}"> 
                            <div class="card" style="position: relative; min-height: 200px; width:100%; margin:10px 0px; padding-bottom:20px">
                                <div class="card-body">
                                <h3 class="card-title">{{ $myReview->user->username }}</h3>
                                @if ($myReview->rating >=8)
                                    <p style="color: blue">Skor: {{ $myReview->rating }}</p>
                                @elseif($rev->rating <=7 && $rev->rating >=4 )
                                    <p style="color: rgba(208, 196, 23, 0.967)">Skor: {{ $myReview->rating }}</p>
                                @else
                                    <p style="color: red">Skor: {{ $myReview->rating }}</p>
                                @endif
                                <p>{!! $myReview->body !!}</p>
                                <div class="footer-action">
                                    <button type="button" class="showedit" data-id="{{ $myReview->id }}" id="btn-action"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                                   
                                    <form method="post" action="/events/{{ $event->slug }}/review/{{ $myReview->id }}" enctype="multipart/form-data" class="d-inline">
                                    @method('delete')
                                    @csrf
                                        {{-- yang penting kan jalan --}}
                                        <input type="hidden" name="my_review_id" value="{{ $myReview->id }}">
                                        <button type="submit" onclick="return confirm('Apa anda yakin?')" id="btn-action"><i class="fa-solid fa-trash"></i> Hapus</button>
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
                                <button type="submit" id="btn-edit"><i class="fa-regular fa-floppy-disk"></i> Simpan</button>
                                <button type="button" id="btn-cancel" class="canceledit" class="canceledit" data-id="{{ $myReview->id }}">Batal</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    @else
                    
                        <div class="col-12"> 
                            <div class="border-bottom" style="margin-bottom:10px;">
                                <h5 style="float: left;">Berikan Ulasan Anda</h5>
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
                                <button type="submit" id="btn-reply">Tambah</button>
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