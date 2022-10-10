{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
     style="padding: 30px 0px 20px 0px">
    <h2>Buat Lokasi</h2>
</div>

<div class="col-lg-8">
    {{-- otomatis ke store karena menggunakan resource --}}
    <form method="post" action="/dashboard/locations" enctype="multipart/form-data">
        @csrf

        {{-- Regency --}}
        <div class="mb-3">
          <label for="regency" class="form-label">Nama Kabupaten</label>
          <input type="text" class="form-control @error('regency') is-invalid @enderror" 
           id="regency" name="regency" value="{{ old('regency') }}" autofocus>
           @error('regency')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>

        {{-- Sub Regency --}}
        <div class="mb-3">
            <label for="sub_regency" class="form-label">Nama Kecamatan</label>
            <input type="text" class="form-control @error('sub_regency') is-invalid @enderror" 
             id="sub_regency" name="sub_regency" value="{{ old('sub_regency') }}">
             @error('sub_regency')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
          </div>

          {{-- Button Action--}}
        <div class="footer-submit-right">
            <button name="action" value="cancel" id="btn-cancel">Batal</button>
            <button type="submit" name="action" value="create" id="btn-reply">Buat</button>
        </div>
    </form>
</div>

@endsection