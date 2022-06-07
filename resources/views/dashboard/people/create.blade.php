{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
     style="padding: 30px 0px 20px 0px">
    <h2>Create New Person</h2>
</div>

<div class="col-lg-8">
    {{-- otomatis ke store karena menggunakan resource --}}
    <form method="post" action="/dashboard/people" enctype="multipart/form-data">
        @csrf

        {{-- Name --}}
        <div class="mb-3">
          <label for="name" class="form-label">Person Name</label>
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
            <label for="picture" class="form-label">Person Picture</label>
            <img class="img-preview">
            <input class="form-control @error('picture') is-invalid @enderror" type="file" id="picture" name="picture" 
            onchange="previewImage()">
            @error('picture')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>

        {{-- Birthday --}}
        <div class="mb-3">
            <label for="birthday" class="form-label">Person Birthday</label>
            <input type="date" class="form-control @error('birthday') is-invalid @enderror" 
             id="birthday" name="birthday" value="{{ old('birthday') }}">
             @error('birthday')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
          </div>

          {{-- TRIX Biography --}}
        <div class="mb-3">
            <label for="biography" class="form-label">Biography</label>
            <input id="biography" type="hidden" name="biography" 
                   value="{{ old('biography') }}">
                <trix-editor input="biography"></trix-editor>
             @error('biography')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection