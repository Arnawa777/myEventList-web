{{-- buat cek keluaran --}}
{{-- @dd($posts) --}}

{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
<div class="container">
    <div class="row forum">
        <nav class="breadcrumb">
            <a href="/forum">Forum </a>
            &nbsp
            >
            &nbsp
            <a href="/forum/{{ $topic->slug }}" class="active">{{ $topic->sub_topic }}</a>
        </nav>
        <div class="col-lg-12">
            <div class="row">
                <!-- Category one -->
                <div class="col-lg-12" id="category">
                    
                    <!-- second section  -->
                    <h4 id="title">Buat Post</h4>
                    {{-- @dd($topic) --}}
                    <form method="post" action="/forum/{{$topic->slug}}" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- Title --}}
                        <div class="mb-3">
                          <label for="title" class="form-label">Judul Post</label>
                          <input type="text" class="form-control @error('title') is-invalid @enderror" 
                            name="title" value="{{ old('title') }}" autofocus>
                           @error('title')
                               <div class="text-danger">
                                   {{ $message }}
                               </div>
                           @enderror
                        </div>
                
                        {{-- Topic --}}
                        <div class="mb-3">
                            <label for="topic_id">Topik Post</label>
                            <select class="form-select" id="topic_id" name="topic_id" value="{{ $topic->id }}">
                                <option value="{{ $topic->id }}">{{ $topic->sub_topic }}</option>
                            </select>
                            @error('topic_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                
                        {{-- Evemt --}}
                        @if ($topic->slug === "event-schedules")
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
                        @endif

                        {{-- Picture --}}
                        <div class="mb-3">
                            <label for="picture" class="form-label">Foto</label>
                            <img class="img-preview">
                            <input class="form-control @error('picture') is-invalid @enderror" type="file" id="picture" name="picture" 
                            onchange="previewImage()">
                            @error('picture')
                               <div class="invalid-feedback">
                                   {{ $message }}
                               </div>
                           @enderror
                        </div>
                
                          {{-- TRIX Body --}}
                        <div class="mb-3">
                            <label for="body" class="form-label">Isi</label>
                            <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                                <trix-editor input="body"></trix-editor>
                             @error('body')
                                 <div class="text-danger">
                                     {{ $message }}
                                 </div>
                             @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Buat</button>
                    </form>
                </div> <!-- Close Category one -->

                
            </div>
        </div>
    </div>
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