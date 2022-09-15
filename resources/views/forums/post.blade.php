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
                <a href="/forum/{{ $topic->slug }}/{{ $post->slug }}" class="active">{{ $post->title }}</a>

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
                        <img class="postPicture" src="/storage/post-picture/{{ $post->picture }}" alt="post-picture">
                        <br>
                        {!! $post->body !!}
                    </article>
                </div>
            </div>

            {{-- Comment --}}
            @if ($post->comments)
                @foreach ($post->comments as $comment)
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
                                <p>{{ $comment->updated_at }}</p>
                                <article class="my-3 fs-5">
                                    {!! $comment->body !!}
                                </article>
                            </div>
                            <div style="bottom: 0px; padding-bottom:10px; position:absolute; width:100%;">
                                @auth
                                    @if ($comment->author->id == auth()->user()->id)
                                            
                                            <button type="button" class="showedit" data-id="{{ $comment->id }}"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                                        
                                            <form method="post" action="/forum/{{ $topic->slug }}/{{ $post->slug }}/comment/{{ $comment->id }}" enctype="multipart/form-data" class="d-inline">
                                            @method('delete')
                                            @csrf
                                                {{-- yang penting kan jalan --}}
                                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                <button type="submit" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i> Delete</button>
                                            </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        {{-- Edit --}}
                        <div class="col-lg-10 right-column" style="position: relative; display:none;" id="replycomment-{{ $comment->id }}">
                            <form method="post" action="/forum/{{ $topic->slug }}/{{ $post->slug }}/comment/{{ $comment->id }}" enctype="multipart/form-data">
                            <p>{{ $comment->updated_at }}</p>
                            @method('put')
                            @csrf
                            {{-- EditBOX --}}
                            <div  style="margin-bottom:70px">
                                <div class="editBox">
                                    <input id="commentEdit-{{ $comment->id }}" type="hidden" name="body" value="{{ $comment->body }}">
                                    <trix-editor input="commentEdit-{{ $comment->id }}"></trix-editor>
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
                            <div class="footer-comment" style="bottom: 0px; padding-bottom:10px; position:absolute; width:100%">
                                <button type="submit" class="btn-sub btn btn-primary">Update Reply</button>
                                <button type="button" class="canceledit" data-id="{{ $comment->id }}">Cancel Edit</button>
                            </div> 
                            
                            </form>
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
            
                            <button type="submit" class="btn-sub btn btn-primary">Post Reply</button>
                        
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.deleteComment', function(){
                if(confirm('Are you sure you want to delete this comment?'))
                {
                    var thisClicked = $(this);
                    var comment_id = thisClicked.val();
                    $.ajax({
                        type: "POST",
                        url: "/delete-comment",
                        data: {
                            'comment_id': comment_id
                        },
                        dataType: "JSON",
                        success: function (res) {
                            if(res.status == 200){
                                thisClicked.closest('comment-container').remove();
                                alert(res.message);
                            }else{
                                alert(res.message);
                            }
                            
                        }
                    });
                }
            });
        });
    </script> --}}
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