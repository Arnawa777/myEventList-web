{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
{{-- <link rel="stylesheet" href="{{ URL::to('/') }}/css/events.css"> --}}
<link rel="stylesheet" href="{{ URL::to('/') }}/css/forum.css">

<div class="col-lg-10" style="border: 1px #9D9EA0 solid; margin-bottom:10px; margin-top:20px;">
    <div class="row">
        <div id="title" >
            <h3 style="padding-left:10px; background-color: #9D9EA0; height:40px">{{ $post->title }}</h3>
        </div>
        <div style="margin-left:10px">
            <a href="/dashboard/posts"class="btn btn-info border-0">Back to All Posts</a>
            {{-- Check user --}}
            @if ($post->author->id === auth()->user()->id)
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning border-0">Edit</a>
            @else
                <a style="pointer-events: none;" class="btn btn-secondary border-0">Edit</a>
            @endif
            
            <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        </div>

        <div class="row post" style="margin-bottom: 0px; padding-bottom:0;">
            {{-- Post --}}
            <div class="row postData" style="margin-bottom: 0;">
                <div class="col-lg-2 left-column">
                    <img class="userPicture" src="/storage/user-picture/{{ $post->author->picture }}">
                    <a href="/profile/{{ $post->author->username }}"><h5 style="text-align: center;">{{ $post->author->username }}</h5></a>
                    <br><br>
                    <h6>Joined: {{ date('d-m-Y', strtotime($post->author->created_at)) }}</h6>
                    <h6>Posts : {{ $post->author->posts_count }}</h6>
                </div>

                <div class="col-lg-10 right-column">
                    <p style="float: left;">{{ $post->created_at }}</p>               
                    <div style="clear: both;"></div>
                    <article class="my-3 fs-5">
                        @if ($post->picture)
                            <img class="postPicture" src="/storage/post-picture/{{ $post->picture }}" alt="post-picture">
                            <br>
                        @endif   
                        {!! $post->body !!}
                    </article>
                </div>
            </div>

            {{-- Comment --}}
            @if ($comments)
                @foreach ($comments as $comment)
                    <div class="row postData" style="margin-bottom: 0; padding-bottom:0;">
                        {{-- View Comment --}}
                        <div class="col-lg-2 left-column">
                            <img class="userPicture" src="/storage/user-picture/{{ $comment->author->picture }}">
                            <a href="/profile/{{ $comment->author->username }}"><h5 style="text-align: center;">{{ $comment->author->username }}</h5></a>
                            <br><br>
                            <h6>Joined: {{ date('d-m-Y', strtotime($comment->author->created_at)) }}</h6>
                            <h6>Posts : {{ $comment->author->posts_count }}</h6>
                        </div>

                        <div class="col-lg-10 right-column" style="position: relative;" id="showcomment-{{ $comment->id }}">
                            <div  style="margin-bottom:50px">
                                <div>
                                    <p style="float: left;">{{ $comment->updated_at }}</p>
                                    <p style="float: right;">#{{ $comments->firstItem()+$loop->index }}</p>
                                    <div style="clear: both;"></div>
                                    {{-- 
                                    <p style="text-align: left; width:49%; display: inline-block;">LEFT</p>
                                    <p style="text-align: right; width:50%;  display: inline-block;">RIGHT</p>  --}}
                                </div>
                                
                                <article class="my-3 fs-5">
                                    {!! $comment->body !!}
                                </article>
                            </div>                   
                            
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="d-flex justify-content-end">
                {{ $comments->links('vendor.pagination.custom') }}
            </div>
        </div>
    

    </div>
</div>



@endsection