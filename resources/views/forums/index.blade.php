{{-- buat cek keluaran --}}
{{-- @dd($posts) --}}

{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
<style>
    table td:not(.count) {
    max-width: 0;
    overflow: hidden;
    text-overflow: ellipsis;
    /* white-space: nowrap; */
  }
</style>

<div class="container">
    <div class="row forum">
        {{-- {{ dd($threads) }} --}}
        {{-- {{dd ($myeventlist) }} --}}
        <nav class="breadcrumb">
            <a href="/forum" class="active">Forum</a>
        </nav>
        {{-- Left Side --}}
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
                                    <a href="/forum/{{ $thread->slug }}">{{ $thread->sub_topic }}</a>
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
                                        <a href="forum/{{ $thread->slug }}/{{ $thread->latestPost->slug }}">
                                            {{ Str::limit($thread->latestPost->title, 20) }}
                                        </a>
                                    </h6>
                                    <div>{{ date('d-m-Y', strtotime($thread->latestPost->created_at)) }}
                                        <a href="/profile/{{ $thread->latestPost->author->username }}">
                                            {{ Str::limit($thread->latestPost->author->username, 10) }}
                                        </a>
                                    </div>
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
                                        <a href="/forum/{{ $thread->slug }}">{{ $thread->sub_topic }}</a>
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
                                            <a href="/forum/{{ $thread->slug }}/{{ $thread->latestPost->slug }}">
                                                {{ Str::limit($thread->latestPost->title, 20) }}
                                            </a>
                                        </h6>
                                        <div>{{ date('d-m-Y', strtotime($thread->latestPost->created_at)) }}
                                            <a href="/profile/{{ $thread->latestPost->author->username }}">
                                                {{ Str::limit($thread->latestPost->author->username, 10) }}
                                            </a>
                                        </div>
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
                                        <a href="/forum/{{ $thread->slug }}">{{ $thread->sub_topic }}</a>
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
                                            <a href="/forum/{{ $thread->slug }}/{{ $thread->latestPost->slug }}">

                                                {{ Str::limit($thread->latestPost->title, 20) }}
                                            </a>
                                        </h6>
                                        <div>{{ date('d-m-Y', strtotime($thread->latestPost->created_at)) }}
                                            <a href="/profile/{{ $thread->latestPost->author->username }}">
                                                {{ Str::limit($thread->latestPost->author->username, 10) }}
                                            </a>
                                        </div>
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
                <p class="text-center fs-4">Data Not Found</p>
            @endif
            </div>
        </div>

        {{-- Right Side --}}
        <div class="col-lg-4">
            <aside>
            <div class="card">
                <h4 class="card-title" 
                style="background-color: #74c0ff; margin: 0; padding: 10px;"
                >Recent Post</h4>
                <div class="card-body">
                
                    <table width="100%">
                        <thead>
                            <tr>
                            <th></th>
                            </tr>
                        </thead>
                    <tbody>
                    @if ($posts->count())
                        @foreach($posts as $post)
                            @if ($post)
                                <tr>
                                    <td>
                                        <h5>
                                        <a href="/forum/{{ $post->topic->slug }}/{{ $post->slug }}">
                                            {{ Str::limit($post->title, 30) }}
                                        </a>
                                        </h5>
                                        <label>
                                            <a href="/forum/{{ $post->topic->slug }}">{{ $post->topic->sub_topic }}</a>
                                            - {{ date('d M Y', strtotime($post->created_at)) }}
                                        </label>
                                    </td>
                                </tr>
                            @else
                                <h1 class="empty">No Data</h1>
                            @endif
                        @endforeach
                    @else
                        <p>There are no posts yet</p>
                    @endif
                    </tbody>
                    </table>
                </div>
            </div>
            </aside>
        </div>
    </div>
</div>
@endsection