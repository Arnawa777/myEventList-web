{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
     style="padding: 30px 0px 20px 0px">
    <h2>Create New Post</h2>
</div>

<div class="col-lg-8">
    {{-- otomatis ke store karena menggunakan resource --}}
    <form method="post" action="/dashboard/posts" enctype="multipart/form-data">
        @csrf

        {{-- Title --}}
        <div class="mb-3">
          <label for="title" class="form-label">Post Title</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" 
           id="title" name="title" value="{{ old('title') }}" autofocus>
           @error('title')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>

        {{-- Topic --}}
        <div class="mb-3">
            <label for="topic_id">Post Topic</label>
            <select class="form-select" id="topic_id" name="topic_id" value="{{ old('topic_id') }}">
                <option value="">Select Topic</option>
                @foreach ($topics as $topic)
                @if (old('topic_id') == $topic->id)
                    <option value="{{ $topic->id }}" selected>{{ $topic->name }}</option>
                @else
                    <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                @endif  
                
                @endforeach
            </select>
            @error('topic_id')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- Evemt --}}
        <div class="mb-3">
            <label for="event_id">Post Event</label>
            <select class="form-select" id="event_id" name="event_id" value="{{ old('event_id') }}">
                <option value="">Select Event</option>
                @foreach ($events as $event)
                @if (old('event_id') == $event->id)
                    <option value="{{ $event->id }}" selected>{{ $event->name }}</option>
                @else
                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                @endif  
                
                @endforeach
            </select>
            @error('event_id')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- Picture --}}
        <div class="mb-3">
            <label for="picture" class="form-label">Post Picture</label>
            <img class="img-preview">
            <input class="form-control @error('picture') is-invalid @enderror" type="file" id="picture" name="picture" 
            onchange="previewImage()">
            @error('picture')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>

          {{-- TRIX Body --}}
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                <trix-editor input="body"></trix-editor>
             @error('body')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection