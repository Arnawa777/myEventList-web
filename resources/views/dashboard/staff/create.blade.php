{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
     style="padding: 30px 0px 20px 0px">
    <h2>Tetapkan Staf</h2>
</div>

<div class="col-lg-8">
    {{-- otomatis ke store karena menggunakan resource --}}
    <form method="post" action="/dashboard/staff" enctype="multipart/form-data">
        @csrf

        {{-- Event --}}
        <div class="mb-3">
            <label for="event_id">Komunitas</label>
            <select class="form-select" id="event" name="event_id" value="{{ old('event_id') }}">
                @foreach ($events as $event)
                @if (old('event_id') == $event->id)
                    <option value="{{ $event->id }}" selected>{{ $event->name }}</option>
                @else
                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                @endif  
                
                @endforeach
            </select>
        </div>

        {{-- Person --}}
        <div class="mb-3">
            <label for="person_id">Orang</label>
            <select class="form-select" name="person_id" value="{{ old('person_id') }}">
                @foreach ($people as $person)
                @if (old('person_id') == $person->id)
                    <option value="{{ $person->id }}" selected>{{ $person->name }}</option>
                @else
                     <option value="{{ $person->id }}">{{ $person->name }}</option>
                @endif
                @endforeach
            </select>
            @error('person_id')
            <div class="alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- Role --}}
        <div class="mb-3">
            <label for="role" class="form-label">Peran Staf</label>
            <input type="text" class="form-control @error('role') is-invalid @enderror" 
             id="role" name="role" value="{{ old('role') }}" autofocus>
             @error('role')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
        </div>

         {{-- TRIX Descriptionn --}}
         <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <input id="description" type="hidden" name="description" 
                   value="{{ old('description') }}">
                <trix-editor input="description"></trix-editor>
             @error('description')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
        </div>

        <div class="mb-3">
            @error('event_id')
            <div class="alert-danger">
                {{ $message }}
            </div>
            @enderror
        </div>

        {{-- Button Action--}}
        <div class="footer-submit-right">
            <button name="action" value="cancel" id="btn-cancel">Batal</button>
            <button type="submit" name="action" value="create" id="btn-reply">Tetapkan</button>
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