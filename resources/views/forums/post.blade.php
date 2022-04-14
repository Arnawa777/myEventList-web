{{-- @dd ($post); --}}

{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')

    <div class="container">
        <div class="row justify-conter-center mb-5">
            <div class="col-md-8">
                <h1 class="mb-3">{{ $post->title }}</h1>

                    <h5>by. <a href="/posts/authors/{{ $post->author->username }}"> {{ $post->author->name }} </a> 
                        in  <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a> 
                    </h5>
                    <img src="https://images.unsplash.com/photo-1442544213729-6a15f1611937?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1632&q=80" class="img-fluid my-4" alt="{{ $post->category->name }}">
                        
                <article class="my-3 fs-5">
                    {!! $post->body !!}
                </article>
                
                <a href="/posts" class="d-block mt-3 py-2">Back to Posts</a>
            </div>
        </div>

    </div>

    
@endsection