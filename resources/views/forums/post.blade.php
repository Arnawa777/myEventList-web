{{-- @dd ($post); --}}

{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
    <div class="container">
        <div class="row post">
            <nav class="breadcrumb">
                <a href="/forum" >Forum </a>
                &nbsp
                >
                &nbsp
                <a href="/forum/{{ $topic->sub_topic }}" >{{ $topic->sub_topic }}</a>
                &nbsp
                >
                &nbsp
                <a href="/forum/{{ $topic->sub_topic }}/{{ $post->slug }}" class="active">{{ $post->title }}</a>

            </nav>
            {{-- Post --}}
            <h4>{{ $post->title }}</h4>
            <div class="row postData">
                <div class="col-lg-2 left-column">
                    <img class="userPicture" src="/storage/user-picture/{{ $post->author->picture }}">
                    <a href="/profile/{{ $post->author->username }}"><h5 style="text-align: center;">{{ $post->author->username }}</h5></a>
                    <br><br>
                    <h6>Joined: {{ date('d-m-Y', strtotime($post->author->created_at)) }}</h6>
                    <h6>Posts : {{ $post->author->posts_count }}</h6>
                </div>

                <div class="col-lg-10 right-column">
                    <p>{{ $post->created_at }}</p>
                    <article class="my-3 fs-5">
                        {!! $post->body !!}
                    </article>
                </div>
            </div>
            {{-- Comment --}}
            @if ($post->comments)
                @foreach ($post->comments as $comment)
                    <div class="row postData">
                        <div class="col-lg-2 left-column ">
                            <img class="userPicture" src="/storage/user-picture/{{ $comment->author->picture }}">
                            <a href="/profile/{{ $comment->author->username }}"><h5 style="text-align: center;">{{ $comment->author->username }}</h5></a>
                            <br><br>
                            <h6>Joined: {{ date('d-m-Y', strtotime($comment->author->created_at)) }}</h6>
                            <h6>Posts : {{ $comment->author->posts_count }}</h6>
                        </div>

                        <div class="col-lg-10 right-column" style="position: relative;">
                            <p>{{ $comment->created_at }}</p>
                            <article class="my-3 fs-5">
                                {!! $comment->body !!}
                            </article>
                            @auth
                                @if ($comment->author->id == auth()->user()->id)
                                    <div class="footer-comment" style="bottom: 0px; padding-bottom:10px; position:absolute; width:100%">
                                        <button><a href="/"><i class="fa-solid fa-pen-to-square"></i>Edit</a></button>
                                       
                                        <form method="post" action="/forum/{{ $topic->sub_topic }}/{{ $post->slug }}/comment/{{ $comment->id }}" enctype="multipart/form-data" class="d-inline">
                                        @method('delete')
							            @csrf
                                            {{-- yang penting kan jalan --}}
                                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                            <button type="submit" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i> Delete</button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            @endif
            {{-- Reply --}}
            @if (auth()->user())
            <div class="row postData">
                <div class="col-lg-2 left-column">
                    <img class="userPicture" src="/storage/user-picture/{{ auth()->user()->picture }}">
                </div>

                <div class="col-lg-10 right-column">
                <form method="post" action="/forum/{{ $topic->sub_topic }}/{{ $post->slug }}/comment" enctype="multipart/form-data">
                @csrf
                    {{-- Description --}}
                    <div class="replyBox">
                        <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                        <trix-editor input="body"></trix-editor>
                        @error('body')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- Wkwkwkw cara gblk --}}
                    <div>
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                    </div>
    
                    <button type="submit" class="btn-sub btn btn-primary">Post Reply</button>
                   
                </form>
                </div>
            </div>
            @endif
        </div>
    </div>

    
@endsection