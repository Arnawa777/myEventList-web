{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
<div class="container">
    <div class="row forum">
        <nav class="breadcrumb">
            <a href="/users">Users </a>
            &nbsp
            >
            &nbsp
            <a href="/profile/{{ $user->username }}">{{ $user->username }}</a>
            &nbsp
            >
            &nbsp
            <a href="/profile/{{ $user->username }}/posts" class="active">{{ $user->username }} Posts</a>
        </nav>
        <div class="col-lg-12">
            <div class="row">
                <!-- Category one -->
                <div class="col-lg-12" id="category">
                    @if ($message = Session::get('error'))
						<div class="alert alert-warning">
							<p>{{ $message }}</p>
						</div>
					@endif
					@if ($message = Session::get('success'))
						<div class="alert alert-success">
							<p>{{ $message }}</p>
						</div>
					@endif
                    <div class="card-header" style="border-bottom: 2px black solid">
                        <h3 class="card-title">{{ $user->username }}'s Posts</h3>
                    </div>
                    <table width="100%">
                        <tbody>
                        @if ($posts->count())
                            @foreach($posts as $post)
                            {{-- {{ $post }} --}}
                            <tr>
                                <td>
                                    <h4>
                                        <a href="/forum/{{ $post->topic->slug }}/{{ $post->slug }}">
                                            
                                            {{ Str::limit($post->title, 50) }}
                                        </a>
                                        
                                    </h4>
                                    <div><a href="/profile/{{ $post->author->username }}">{{ $post->author->username }}</a> - 
                                        {{ date('d-m-Y', strtotime($post->created_at)) }}</div>
                                </td>
                                <td>
                                    <a href="/forum/{{ $post->topic->slug }}">
                                        {{ $post->topic->sub_topic }}
                                    </a>
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
                                <td>
                                    @auth
                                        @if ($post->author->id == auth()->user()->id)
                                            <div style="float: right; display:flex">
                                                <form action="/forum/{{ $post->topic->slug }}/{{ $post->slug }}/edit">
                                                    <button style="margin:0 10px 0 0;"> <i class="fa-solid fa-pen-to-square"></i></button>
                                                </form>
                                                <form action="/forum/{{ $post->topic->slug }}/{{ $post->slug }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    
                                                    <input type="hidden" name="redirect" value="profile">
                                                    <button style="margin:0 0 0 0;" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        @elseif (auth()->user()->role === "admin")
                                            <div style="float: right; display:flex">
                                                <form action="/forum/{{ $post->topic->slug }}/{{ $post->slug }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <input type="hidden" name="redirect" value="profile">
                                                    <button style="margin:0 0 0 0;" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash"></i></button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <p class="text-center fs-4">There are no posts from this user</p> 
                        </tr>
                        @endif
                        </tbody>
                        
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $posts->links('vendor.pagination.custom') }}
                    </div>
                </div> <!-- Close Category one -->

            </div>
        </div>
    </div>
</div>

@endsection
