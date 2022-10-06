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
                <a href="/forum/{{ $topic->slug }}" >{{ $topic->sub_topic }}</a>
                &nbsp
                >
                &nbsp
                <a href="/forum/{{ $topic->slug }}/{{ $post->slug }}" class="active">
                    {{ Str::limit($post->title, 20, $end='...') }}
                </a>

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
                    <p style="float: left;">{{ $post->created_at }}</p>
                    @auth
                        @if ($post->author->id == auth()->user()->id)
                            <div style="float: right; display:flex">
                                <form action="/forum/{{ $topic->slug }}/{{ $post->slug }}/edit">
                                    <button style="margin:0 10px 0 0;"> <i class="fa-solid fa-pen-to-square"></i></button>
                                </form>
                                <form action="/forum/{{ $topic->slug }}/{{ $post->slug }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" name="topic_slug" value="{{ $topic->slug }}">
                                    <button style="margin:0 0 0 0;" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        @elseif (auth()->user()->role === "admin")
                            <div style="float: right; display:flex">
                                <form action="/forum/{{ $topic->slug }}/{{ $post->slug }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" name="topic_slug" value="{{ $topic->slug }}">
                                    <button style="margin:0 0 0 0;" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        @endif
                    @endauth                    
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
                    <div class="row postData">
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
                            @auth
                                @if ($comment->author->id == auth()->user()->id)
                                    <div class="footer-action">
                                        <button type="button" class="showedit" id="btn-action" data-id="{{ $comment->id }}"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                                    
                                        <form method="post" action="/forum/{{ $topic->slug }}/{{ $post->slug }}/comment/{{ $comment->id }}" enctype="multipart/form-data" class="d-inline">
                                        @method('delete')
                                        @csrf
                                            {{-- yang penting kan jalan --}}
                                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                            <button type="submit" onclick="return confirm('Are you sure?')" id="btn-action"><i class="fa-solid fa-trash"></i> Delete</button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                            
                        </div>
                        {{-- Edit --}}
                        <div class="col-lg-10 right-column" style="position: relative; display:none;" id="replycomment-{{ $comment->id }}">
                            <form method="post" action="/forum/{{ $topic->slug }}/{{ $post->slug }}/comment/{{ $comment->id }}" enctype="multipart/form-data">
                            <p>{{ $comment->updated_at }}</p>
                            @method('put')
                            @csrf
                            {{-- EditBOX --}}
                            <div  style="margin-bottom:25px">
                                <div class="editBox">
                                    <input id="commentEdit-{{ $comment->id }}" type="hidden" name="body" value="{{ $comment->body }}">
                                    <trix-editor input="commentEdit-{{ $comment->id }}" style="min-height: 190px;"></trix-editor>
                                    @error('commentEdit')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- PASS comment ID --}}
                                <div>
                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                </div>
                            </div> {{--! End of Editbox  --}}
                            <div class="footer-button">
                                <button type="submit" id="btn-edit"><i class="fa-regular fa-floppy-disk"></i> SAVE</button>
                                <button type="button" class="canceledit" id="btn-cancel" data-id="{{ $comment->id }}">CANCEL</button>
                            </div> 
                            
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="d-flex justify-content-end">
                {{ $comments->links('vendor.pagination.custom') }}
            </div>

            {{-- Reply --}}
            @if (auth()->user())
                <div class="row postData">
                    <div class="col-lg-2 left-column">
                        <img class="userPicture" src="/storage/user-picture/{{ auth()->user()->picture }}">
                    </div>

                    <div class="col-lg-10 right-column">
                        <form method="post" action="/forum/{{ $topic->slug }}/{{ $post->slug }}/comment" enctype="multipart/form-data">
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
                            <div class="footer-reply-right">
                                <button type="submit" id="btn-reply"><i class="fa-solid fa-reply"></i> POST REPLY</button>
                            </div>           
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function(){
            // change the selector to use a class
            $(".showedit").click(function(){
                // this will query for the clicked toggle
                var $toggle = $(this); 
    
                // build the target form id
                var showid = "#showcomment-" + $toggle.data('id'); 
                var editid = "#replycomment-" + $toggle.data('id'); 
    
                $( showid ).hide();
                $( editid ).show();
            });
            $(".canceledit").click(function(){
                // this will query for the clicked toggle
                var $toggle = $(this); 
    
                // build the target form id
                var showid = "#showcomment-" + $toggle.data('id'); 
                var editid = "#replycomment-" + $toggle.data('id'); 
    
                $( showid ).show();
                $( editid ).hide();
            });
        });
    </script>
@endsection