{{-- buat cek keluaran --}}
{{-- @dd($posts) --}}

{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
    
    <div class="container">
        <h1>{{ $title }}</h1>
    {{-- @if ($posts->count() > 0) --}}
    @if ($posts->count())
        <div class="card mb-3">
            <img src="https://www.dartmoorzoo.org.uk/wp-content/uploads/2021/01/Tiger-1.jpg" class="card-img-top" alt="{{ $posts[0]->topic->name }}">
            <div class="card-body text-center">
                <h5 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h5>

                <p>
                    <small class="text-muted"> 
                        by.<a href="/posts/authors/{{ $posts[0]->author->username }}" class="text-decoration-none">{{ $posts[0]->author->name }}</a>  
                        in <a href="/topic/{{ $posts[0]->topic->slug }}" class="text-decoration-none">{{ $posts[0]->topic->name }}</a>
                        {{ $posts[0]->updated_at->diffForHumans() }}
                    </small>
                </p>

                <p class="card-text">{{ $posts[0]->excerpt }}</p>
                
                <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-primary">Read more</a>
            </div>
        </div>
    @else
        <p class="text-center fs-4">404 No Post Found.</p>  
    @endif
    </div>
    
    <div class="container">
        <div class="row">
            @foreach ($posts->skip(1) as $post)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="position-absolute bg-dark px-3 py-2"
                        style="background-color: rgba(0, 0, 0, 0.103)">
                        <a href="/categories/{{ $post->topic->slug }}" class="text-decoration-none text-white">{{ $post->topic->name }}
                        </a>
                        </div>

                        <img src="https://images.unsplash.com/photo-1442544213729-6a15f1611937?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1632&q=80" class="card-img-top" alt="{{ $post->topic->name }}">
                        <div class="card-body">
                        <h5 class="card-title">
                            <a href="/posts/{{ $post->slug }}" class="text-decoration-none text-dark">{{ $post->title }}</a>
                        </h5>
                        <p>
                            <small class="text-muted"> 
                                by.<a href="/posts/authors/{{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a>  
                                
                                {{ $post->updated_at->diffForHumans() }}
                            </small>
                        </p>
                        <p class="card-text">{{ $post->excerpt }}</p>
                        <a href="/posts/{{ $post->slug }}" class="btn btn-primary">
                            Read More
                        </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    

@endsection

