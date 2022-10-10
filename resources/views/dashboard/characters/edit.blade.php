{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
     style="padding: 30px 0px 20px 0px">
    <h2>Ubah Karakter</h2>
</div>

<div class="col-lg-8">
    {{-- otomatis ke update karena menggunakan resource --}}
    <form method="post" action="/dashboard/characters/{{ $chara->slug }}" enctype="multipart/form-data">
        @method('put')
        @csrf

        {{-- Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nama Karakter</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
            id="name" name="name" value="{{ old('name', $chara->name) }}" autofocus>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
  
        {{-- Picture --}}
        <div class="mb-3">
            <label for="picture" class="form-label">Foto Karakter</label>
            <input type="hidden" name="oldPicture" value="{{ $chara->picture }}">
            @if ($chara->picture)
                <img src="{{ asset('storage/character-picture/' .$chara->picture) }}" class="img-preview">
            @else
                <img class="img-preview">
            @endif
            
            <div style="display: flex">
                <div class="col-lg-10" style="width: 400px; margin-right: 20px">
                    <input class="form-control @error('picture') is-invalid @enderror" type="file" id="picture" name="picture" 
                    value="{{ $chara->picture }}" onchange="previewImageData()">
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-danger" name="action" value="remove" onclick="return confirm('Apa anda yakin?')">Hapus</button>
                </div>
            </div>
            @error('picture')
               <div style="color: red">
                   {{ $message }}
               </div>
           @enderror
        </div>
  
        {{-- TRIX Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <input id="description" type="hidden" name="description" 
                    value="{{ old('description', $chara->description) }}">
                <trix-editor input="description"></trix-editor>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Button Action --}}
        <div class="footer-submit-right">
            <button name="action" value="cancel" id="btn-cancel">Batal</button>
            <button type="submit" name="action" value="update" id="btn-reply">Ubah</button>
        </div>
        
    </form>
</div>

@endsection