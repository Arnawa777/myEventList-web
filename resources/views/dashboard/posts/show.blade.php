{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<link rel="stylesheet" href="{{ URL::to('/') }}/css/events.css">

<div class="col-lg-9 my-4" id="land-event">
    <div class="row" style="padding: 0px 10px">
        <div class="col-md-12" id="title">
            <h3>{{ $post->title }}</h3>
        </div>
        <div style="padding-bottom: 10px">
            <a href="/dashboard/posts"
            class="btn btn-info border-0">
            <span data-feather="arrow-left"></span> Back to List Post
        </a>
        <a href="/dashboard/posts/{{ $post->slug }}/edit"
            class="btn btn-warning border-0">
            <span data-feather="edit"></span> Edit
        </a>
        <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">  
            <span data-feather="x-circle"></span> Delete</button>
            </form>
        </div>
        <div>
            @if ($post->picture)
                <img class="post-img" src="/storage/post-picture/{{ $post->picture }}" alt="post-img">
            @else
                <img class="post-img" src="https://cdn.discordapp.com/attachments/729406248637956196/896117975281717358/1633607783751.jpg" alt="uwu">
            @endif
            <article class="my-3 fs-5">
                {!! $post->body !!}
            </article>
        </div>

        
    

    </div>
</div>



@endsection