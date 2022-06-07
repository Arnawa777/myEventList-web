{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
     style="padding: 30px 0px 20px 0px">
    <h2>Create New Character</h2>
</div>

<div class="col-lg-8">
    {{-- otomatis ke store karena menggunakan resource --}}
    <form method="post" action="/dashboard/characters" enctype="multipart/form-data">
        @csrf

        {{-- Name --}}
        <div class="mb-3">
          <label for="name" class="form-label">Character Name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" 
           id="name" name="name" value="{{ old('name') }}" autofocus>
           @error('name')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>

        {{-- Picture --}}
        <div class="mb-3">
            <label for="picture" class="form-label">Character Picture</label>
            <img class="img-preview">
            <input class="form-control @error('picture') is-invalid @enderror" type="file" id="picture" name="picture" 
            onchange="previewImage()">
            @error('picture')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>

        {{-- Role --}}
        <div class="mb-3">
            <label for="role" class="form-label">Character Role</label>
            <input type="text" class="form-control @error('role') is-invalid @enderror" 
             id="role" name="role" value="{{ old('role') }}">
             @error('role')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
          </div>

          {{-- TRIX Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input id="description" type="hidden" name="description">
                <trix-editor input="description"></trix-editor>
             @error('description')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection