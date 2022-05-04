{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
    
<div class="container mt-4">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img class="img-fluid"  src="/storage/user-picture/{{ auth()->user()->picture }}" style="width:150px; height:150px; object-fit: cover; float:left; border-radius:50%; margin-right:25px;">
            <h1>
                @if (is_null(auth()->user()->name))
                    {{ auth()->user()->username }}'s Profile
                @else
                    {{ Str::words(auth()->user()->name, 2, '') }}'s Profile
                @endif
            </h1>
            <div class="card-body">
                <form action="/profile" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="image" id="image">
                    @error('image')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <input type="submit" value="Upload">
                </form>
            </div>

            {{-- null coalescing operator --}}
            {{-- <h1>{{ auth()->user()->username ?? auth()->user()->name }} </h1>   --}}
        </div>

    </div>
    
</div>

@endsection