{{-- buat cek keluaran --}}
{{-- @dd($posts) --}}

{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
<div class="container">
    <div class="row forum">
        <nav class="breadcrumb">
            <a href="/forum">Forum </a>
            &nbsp
            >
            &nbsp
            <a href="/forum/{{ $topic->sub_topic }}" class="active">{{ $topic->sub_topic }}</a>
        </nav>
        <div class="col-lg-12">
            <div class="row">
                <!-- Category one -->
                <div class="col-lg-12" id="category">
                    <h4><a href="">Create New Post</a></h4>
                    <!-- second section  -->
                    <h4 id="title">{{ $topic->sub_topic }}</h4>
                    <table width="100%">
                        <thead>
                            <tr>
                            <th width="55%"  id="topic"></th>
                            <th width="20%" style="text-align: center"></th>
                            <th width="25%"></th>
                            </tr>
                        </thead>
                    <tbody>
                        @foreach($topic->posts as $post)
                        {{-- {{ $post }} --}}
                        <tr>
                            <td  id="topic">
                                <h4>
                                    <a href="/forum/{{ $topic->sub_topic }}/{{ $post->slug }}">{{ $post->title }}</a>
                                    </h4>
                                <div><a href="/profile/{{ $post->author->username }}">{{ $post->author->username }}</a> - 
                                    {{ date('d-m-Y', strtotime($post->created_at)) }}</div>
                            </td>
                            <td class="count">
                                <div class="first">N/A <br> Views</div>
                                <div class="last">{{ $post->comments->count() }} <br>Comment</div>
                                
                            </td>
                            <td>
                            @if ($post->latestComment)
                                <h6 class="font-weight-bold mb-0" style="white-space: nowrap;
                                overflow: hidden;
                                display: block;
                                text-overflow: ellipsis;">
                                    {!!  Str::limit($post->latestComment->body, 35, $end='...')  !!}
                                    {{-- {!!  substr(strip_tags($post->latestComment->body), 0, 25) !!} --}}
                                    {{-- {{ $post->latestComment->body }} --}}
                                </h6>
                                <div>{{ date('d-m-Y', strtotime($post->latestComment->created_at)) }}
                                    <a href="/profile/{{ $post->latestComment->author->username }}">{{ $post->latestComment->author->username }}</a></div>
                            @else
                                <h6 class="text-center font-weight-bold mb-0">
                                    No Comments
                                </h6>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection