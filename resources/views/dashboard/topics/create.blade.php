{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
     style="padding: 30px 0px 20px 0px">
    <h2>Buat Topik</h2>
</div>

<div class="col-lg-8">
    {{-- otomatis ke store karena menggunakan resource --}}
    <form method="post" action="/dashboard/topics" enctype="multipart/form-data">
        @csrf
        
        {{-- Topic --}}
        <div class="mb-3">
            <label for="topic" class="form-label">Topik</label>
            <select class="form-select" name="topic" value="{{ old('topic')}}">
                @if (old('topic'))
                    <option value="">Pilih Topik</option>
                    <option {{ old('topic') == 'SanggarJogja' ? 'selected' : '' }}  value="SanggarJogja">SanggarJogja</option>
                    <option {{ old('topic') == 'Komunitas' ? 'selected' : '' }}  value="Komunitas">Komunitas</option>
                    <option {{ old('topic') == 'Umum' ? 'selected' : '' }}  value="Umum">Umum</option>
                @else
                    <option value="">Pilih Topik</option>
                    <option value="SanggarJogja">SanggarJogja</option>
                    <option value="Komunitas">Komunitas</option>
                    <option value="Umum">Umum</option>
                @endif
            </select>
            @error('topic')
               <div style="color: red">
                   {{ $message }}
               </div>
           @enderror
        </div>

        <div class="mb-3">
          <label for="sub_topic" class="form-label">Sub Topik</label>
          <input type="text" class="form-control @error('sub_topic') is-invalid @enderror" 
           id="sub_topic" name="sub_topic" value="{{ old('sub_topic') }}" autofocus>
           @error('sub_topic')
               <div style="color: red">
                   {{ $message }}
               </div>
           @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" 
             id="description" name="description" value="{{ old('description') }}">
             @error('description')
                 <div style="color: red">
                     {{ $message }}
                 </div>
             @enderror
        </div>
        
        {{-- Button Action --}}
        <div class="footer-submit-right">
            <button name="action" value="cancel" id="btn-cancel">Batal</button>
            <button type="submit" name="action" value="create" id="btn-reply">Buat</button>
        </div> 
    </form>
</div>

@endsection