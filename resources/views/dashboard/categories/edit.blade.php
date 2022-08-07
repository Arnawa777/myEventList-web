{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
     style="padding: 30px 0px 20px 0px">
    <h2>Edit Category</h2>
</div>

<div class="col-lg-8">
    {{-- otomatis ke update karena menggunakan resource --}}
    <form method="post" action="/dashboard/categories/{{ $category->slug }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Category Name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" 
           id="name" name="name" value="{{ old('name', $category->name) }}" autofocus>
           @error('name')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection