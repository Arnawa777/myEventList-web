{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
     style="padding: 30px 0px 20px 0px">
    <h2>Edit Location</h2>
</div>

<div class="col-lg-8">
    {{-- otomatis ke update karena menggunakan resource --}}
    <form method="post" action="/dashboard/locations/{{ $location->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf

        {{-- Regency --}}
        <div class="mb-3">
          <label for="regency" class="form-label">Regency Name</label>
          <input type="text" class="form-control @error('regency') is-invalid @enderror" 
           id="regency" name="regency" value="{{ old('regency', $location->regency) }}" autofocus>
           @error('regency')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>

        {{-- Sub Regency --}}
        <div class="mb-3">
            <label for="sub_regency" class="form-label">Sub Regency Name</label>
            <input type="text" class="form-control @error('sub_regency') is-invalid @enderror" 
             id="sub_regency" name="sub_regency" value="{{ old('sub_regency', $location->sub_regency) }}">
             @error('sub_regency')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
          </div>

          {{-- Button Action--}}
        <div class="footer-submit-right">
            <button name="action" value="cancel" id="btn-cancel">Cancel</button>
            <button type="submit" name="action" value="update" id="btn-reply">Update</button>
        </div>
    </form>
</div>

@endsection