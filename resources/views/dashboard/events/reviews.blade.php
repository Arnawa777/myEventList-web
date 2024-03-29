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
            <span data-feather="edit"></span> Edit
        </a>
        <form action="/dashboard/events/{{ $event->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-danger" onclick="return confirm('Apa anda yakin?')">  
            <span data-feather="x-circle"></span> Hapus</button>
            </form>
        </div>

        {{-- Left Side --}}
        <div class="col-sm-3">
            <div class="row" id="main-row">
                <div style="margin-bottom:20px;">
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
                    {{-- View Comment --}}
                    
                    
                    @empty
                        <p>Belum ada ulasan yang diberikan pada komunitas ini</p>
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