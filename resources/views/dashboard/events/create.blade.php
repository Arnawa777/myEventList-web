{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
	 style="padding: 30px 0px 20px 0px">
    <h2>Create New Event</h2>
</div>

<div class="col-lg-8">
    {{-- otomatis ke store karena menggunakan resource --}}
    <form method="post" action="/dashboard/events" enctype="multipart/form-data">
        @csrf

        {{-- Name --}}
        <div class="mb-3">
          <label for="name" class="form-label">Event Name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" 
           id="name" name="name" value="{{ old('name') }}" autofocus>
           @error('name')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>

        {{-- Category --}}
        <div class="mb-3">
            <label for="category_id">Category</label>
            <select class="form-select" id="category_id" name="category_id" value="{{ old('category_id') }}">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                @if (old('category_id') == $category->id)
                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                @else
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif  
                
                @endforeach
            </select>
            @error('category_id')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- Location --}}
        <div class="mb-3">
          <label for="location_id" class="form-label">Event Location</label>
          <input type="text" class="form-control @error('location_id') is-invalid @enderror" 
           id="location_id" name="location_id" value="{{ old('location_id') }}">
           @error('location_id')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>

        {{-- Phone --}}
        <div class="mb-3">
          <label for="phone" class="form-label">Event Phone</label>
          <input type="text" class="form-control @error('phone') is-invalid @enderror" 
           id="phone" name="phone" value="{{ old('phone') }}">
           @error('phone')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>

        {{-- Date --}}
        <div class="mb-3">
          <label for="date" class="form-label">Event Established</label>
          <input type="date" class="form-control @error('date') is-invalid @enderror" 
           id="date" name="date" value="{{ old('date') }}">
           @error('date')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>

        {{-- Picture --}}
        <div class="mb-3">
            <label for="picture" class="form-label">Event Picture</label>
            <img class="img-preview">
            <input class="form-control @error('picture') is-invalid @enderror" type="file" id="picture" name="picture" 
            onchange="previewImage()">
            @error('picture')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>

        {{-- Video --}}
        <div class="mb-3">
            <label for="video" class="form-label">Event Video</label>
            <input type="text" class="form-control @error('video') is-invalid @enderror" 
             id="video" name="video" value="{{ old('video') }}">
             @error('video')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label for="synopsis" class="form-label">Synopsis</label>
            <input id="synopsis" type="hidden" name="synopsis" value="{{ old('synopsis') }}">
            <trix-editor input="synopsis"></trix-editor>
             @error('synopsis')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
        </div>
        
        <button type="submit" class="btn-sub btn btn-primary">Submit</button>
    </form>
</div>

@endsection