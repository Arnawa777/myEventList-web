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
            <div class="col-lg-10" style="width: 400px; margin-right: 20px">
            <input class="form-control @error('picture') is-invalid @enderror" type="file" name="picture" id="picture" onchange="previewImageData()">
            </div>
            @error('picture')
               <div style="color: red">
                   {{ $message }}
               </div>
           @enderror
        </div>

        {{-- Role --}}
        <div class="mb-3">
            <label for="role">Character Role</label>
            <select class="form-select" name="role" value="{{ old('role') }}">
                    @if (old('role'))
                        <option {{ old('role') == 'Main' ? 'selected' : '' }}  value="Main">Main</option>
                        <option {{ old('role') == 'Support' ? 'selected' : '' }}  value="Support">Support</option>
                    @else
                        <option value="Main">Main</option>
                        <option value="Support">Support</option>
                    @endif
            </select>
                @error('role')
                    <div class="alert-danger">
                        {{ $message }}
                    </div>
                @enderror
        </div>

        {{-- TRIX Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input id="description" type="hidden" name="description" value="{{ old('description') }}">
                <trix-editor input="description"></trix-editor>
             @error('description')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
        </div>

        {{-- Button Action--}}
        <div class="footer-submit-right">
            <button name="action" value="cancel" id="btn-cancel">Cancel</button>
            <button type="submit" name="action" value="create" id="btn-reply"><i class="fa-regular fa-pen-to-square"></i> Submit</button>
        </div>
    </form>
</div>

@endsection