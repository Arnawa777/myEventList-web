{{-- buat cek keluaran --}}
{{-- @dd($posts) --}}

{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
<div class="container">
    <div class="row forum">
        {{-- {{ dd($threads) }} --}}
        {{-- {{dd ($myeventlist) }} --}}
        <nav class="breadcrumb">
            <a href="/forum" class="active">Forum</a>
        </nav>
        <div class="col-lg-8">
            <div class="row">
            @if ($threads->count())
                <!-- Category one -->
                <div class="col-lg-12" id="category">
                    <!-- second section  -->
                    <h4 id="title">MyEventList</h4>
                    <table width="100%">
                        <thead>
                            <tr>
                            <th width="55%" id="topic"></th>
                            <th width="20%" style="text-align: center"></th>
                            <th width="25%"></th>
                            </tr>
                        </thead>
                    <tbody>
                    @foreach($threads->where('topic', 'MyEventList') as $thread)
                        @if ($thread)
                            <tr>
                                <td id="topic">
                                    <h5>
                                    <a href="/forum/{{ $thread->sub_topic }}">{{ $thread->sub_topic }}</a>
                                    </h5>
                                    {{-- Check Description not null --}}
                                    @if ($thread->description)
                                    <p class="mb-0">
                                        {{ $thread->description }}
                                    </p>
                                    @endif
                                </td>
                                <td class="count">
                                    <div class="first">N/A <br> Views</div>
                                    <div class="last">{{ $thread->posts->count() }} <br>Posts</div>
                                </td>
                                <td>
                                    @if ($thread->latestPost)
                                    <h6 class="font-weight-bold mb-0">
                                        <a href="#">{{ $thread->latestPost->title }}</a>
                                    </h6>
                                    <div>{{ date('d-m-Y', strtotime($thread->latestPost->created_at)) }}
                                        <a href="/profile/{{ $thread->latestPost->author->username }}">{{ $thread->latestPost->author->username }}</a></div>
                                    @else
                                        <h6 class="text-center font-weight-bold mb-0">
                                            No Post
                                        </h6>
                                    @endif
                                </td>
                            </tr>
                        @else
                            <h1 class="empty">No Data</h1>
                        @endif
                    @endforeach
                    </tbody>
                    </table>
                </div>

                <!-- Category two -->
                <div class="col-lg-12" id="category">
                    <!-- second section  -->
                    <h4 id="title">Event</h4>
                    <table width="100%">
                    <thead>
                        <tr>
                            <th width="55%"></th>
                            <th width="20%" style="text-align: center"></th>
                            <th width="25%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($threads->where('topic', 'Event') as $thread)
                            @if ($thread)
                                <tr>
                                    <td id="topic">
                                        <h5>
                                        <a href="#">{{ $thread->sub_topic }}</a>
                                        </h5>
                                        {{-- Check Description not null --}}
                                        @if ($thread->description)
                                        <p class="mb-0">
                                            {{ $thread->description }}
                                        </p>
                                        @endif
                                    </td>
                                    <td class="count">
                                        <div class="first">N/A <br> Views</div>
                                        <div class="last">{{ $thread->posts->count() }} <br>Posts</div>
                                    </td>
                                    <td>
                                        @if ($thread->latestPost)
                                        <h6 class="font-weight-bold mb-0">
                                            <a href="#">{{ $thread->latestPost->title }}</a>
                                        </h6>
                                        <div>{{ date('d-m-Y', strtotime($thread->latestPost->created_at)) }}
                                            <a href="/profile/{{ $thread->latestPost->author->username }}">{{ $thread->latestPost->author->username }}</a></div>
                                        @else
                                            <h6 class="text-center font-weight-bold mb-0">
                                                No Post
                                            </h6>
                                        @endif
                                    </td>
                                </tr>
                            @else
                                <h1 class="empty">No Data</h1>
                            @endif
                        @endforeach
                    </tbody>
                    </table>
                </div>

                <!-- Category three -->
                <div class="col-lg-12" id="category">
                    <!-- second section  -->
                    <h4 id="title">General</h4>
                    <table width="100%">
                    <thead>
                        <tr>
                            <th width="55%"></th>
                            <th width="20%" style="text-align: center"></th>
                            <th width="25%"></th>
                        </tr>
                    </thead>  
                    <tbody>
                        @foreach($threads->where('topic', 'General') as $thread)
                            @if ($thread)
                                <tr>
                                    <td id="topic">
                                        <h5>
                                        <a href="#">{{ $thread->sub_topic }}</a>
                                        </h5>
                                        {{-- Check Description not null --}}
                                        @if ($thread->description)
                                        <p class="mb-0">
                                            {{ $thread->description }}
                                        </p>
                                        @endif
                                    </td>
                                    <td class="count">
                                        <div class="first">N/A <br> Views</div>
                                        <div class="last">{{ $thread->posts->count() }} <br>Posts</div>
                                    </td>
                                    <td>
                                        @if ($thread->latestPost)
                                        <h6 class="font-weight-bold mb-0">
                                            <a href="#">{{ $thread->latestPost->title }}</a>
                                        </h6>
                                        <div>{{ date('d-m-Y', strtotime($thread->latestPost->created_at)) }}
                                            <a href="/profile/{{ $thread->latestPost->author->username }}">{{ $thread->latestPost->author->username }}</a></div>
                                        @else
                                            <h6 class="text-center font-weight-bold mb-0">
                                                No Post
                                            </h6>
                                        @endif
                                    </td>
                                </tr>
                            @else
                                <h1 class="empty">No Data</h1>
                            @endif
                        @endforeach
                    </tbody> 
                    </table>
                </div>
            @else
                <p class="text-center fs-4">404</p>
                <p class="text-center fs-4">Data Not Found</p>
            @endif
            </div>
        </div>
      {{-- Right Side --}}
        <div class="col-lg-4">
            <aside>
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Members Online</h4>
                <ul class="list-unstyled mb-0">
                    <li><a href="#">Member name</a></li>
                    <li><a href="#">Member name</a></li>
                    <li><a href="#">Member name</a></li>
                    <li><a href="#">Member name</a></li>
                    <li><a href="#">Member name</a></li>
                </ul>
                </div>
                <div class="card-footer">
                <dl class="row">
                    <dt class="col-8 mb-0">Total:</dt>
                    <dd class="col-4 mb-0">10</dd>
                </dl>
                <dl class="row">
                    <dt class="col-8 mb-0">Members:</dt>
                    <dd class="col-4 mb-0">10</dd>
                </dl>
                <dl class="row">
                    <dt class="col-8 mb-0">Guests:</dt>
                    <dd class="col-4 mb-0">3</dd>
                </dl>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                <h4 class="card-title">Members Statistics</h4>
                <dl class="row">
                    <dt class="col-8 mb-0">Total Forums:</dt>
                    <dd class="col-4 mb-0">15</dd>
                </dl>
                <dl class="row">
                    <dt class="col-8 mb-0">Total Topics:</dt>
                    <dd class="col-4 mb-0">500</dd>
                </dl>
                <dl class="row">
                    <dt class="col-8 mb-0">Total members:</dt>
                    <dd class="col-4 mb-0">200</dd>
                </dl>
                </div>
                <div class="card-footer">
                <div>Newest Member</div>
                <div><a href="#">Member Name</a></div>
                </div>
            </div>
            </aside>
        </div>
    </div>
</div>
@endsection