{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
     style="padding: 30px 0px 20px 0px">
    <h2>Buat Post</h2>
</div>

<div class="col-lg-8">
    {{-- otomatis ke store karena menggunakan resource --}}
    <form method="post" action="/dashboard/posts" enctype="multipart/form-data">
        @csrf

        {{-- Title --}}
        <div class="mb-3">
          <label for="title" class="form-label">Judul Post</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" 
           id="title" name="title" value="{{ old('title') }}" autofocus>
           @error('title')
               <div class="invalid-feedback">
                   {{ $message }}
               </div>
           @enderror
        </div>

        {{-- Topic --}}
        <div class="mb-3">
            <label for="topic_id">Topik Post</label>
            <select class="form-select" id="topic_id" name="topic_id" value="{{ old('topic_id') }}">
                <option value="">Pilih Topik</option>
                @foreach ($topics as $topic)
                @if (old('topic_id') == $topic->id)
                    <option value="{{ $topic->id }}" selected>{{ $topic->topic }} - {{ $topic->sub_topic }}</option>
                @else
                    <option value="{{ $topic->id }}">{{ $topic->topic }} - {{ $topic->sub_topic }}</option>
                @endif  
                
                @endforeach
            </select>
            @error('topic_id')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- Evemt --}}
        <div class="mb-3">
            <label for="event_id">Komunitas</label>
            <select class="form-select" id="event_id" name="event_id" value="{{ old('event_id') }}">
                <option value="">Pilih Komunitas</option>
                @foreach ($events as $event)
                @if (old('event_id') == $event->id)
                    <option value="{{ $event->id }}" selected>{{ $event->name }}</option>
                @else
                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                @endif  
                
                @endforeach
            </select>
            @error('event_id')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- Picture --}}
        <div class="mb-3">
            <label for="picture" class="form-label">Foto</label>
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

          {{-- TRIX Body --}}
        <div class="mb-3">
            <label for="body" class="form-label">Isi</label>
            <input id="body" type="hidden" name="body" value="{{ old('body') }}"
            class="@error('body') is-invalid @enderror">
                <trix-editor input="body"></trix-editor>
             @error('body')
                 <div style="color: red">
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

<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.form-select').select2();
    });

    // autofocus search
    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });
</script>

@endsection