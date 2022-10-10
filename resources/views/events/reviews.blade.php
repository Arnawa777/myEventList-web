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
            <div class="col-sm-3" style="background: #333333; border: 1px white solid; color:white;">
                <div class="row" id="main-row">
                    <div class="parent-cover-event" style="margin-top:10px; margin-bottom:20px;" id="event_id">
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
                            <button type="submit" class="btn btn-sm btn-outline-danger">
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
                <div id="horiznav_nav" style="margin: 5px 0 10px 0;">
                    <ul style="margin-right: 0; padding-right: 0;">
                          <li><a href="/events/{{ $event->slug }}">Detail</a>
                      </li>
                          <li><a href="/events/{{ $event->slug }}/characters">Karakter &amp; Staf</a>
                      </li>
                          <li><a href="/events/{{ $event->slug }}/reviews">Ulasan</a>
                      </li>
                      </ul>
                </div>
                
                {{-- Review --}}
                <div class="row" id="main-row">
                    <div class="col-12"> 
                        <div class="border-bottom" style="margin-bottom:10px;">
                            <h5 style="float: left;">Ulasan</h5>
                            <div style="clear: left;"></div>
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
                                            <img class="review-img-empty" src="{{ URL::to('/') }}/img/No_image_available.svg" alt="no-img">
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
                                    <div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- View Comment --}}
                        @empty
                            <p>Belum ada ulasan yang diberikan pada Komunitas ini</p>
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