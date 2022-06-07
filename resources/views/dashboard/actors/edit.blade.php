{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
style="padding: 30px 0px 20px 0px">
    <h2>Update Actor</h2>
</div>

<div class="col-lg-8">
    {{-- otomatis ke store karena menggunakan resource --}}
    <form method="post" action="/dashboard/actors/{{ $actor->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf

        {{-- Person --}}
        <div class="mb-3">
            <label for="person_id">Person</label>
            <select class="form-select" name="person_id" value="{{ old('person_id') }}">
                @foreach ($people as $person)
                    @if (old('person_id', $actor->person_id) == $person->id)
                        <option value="{{ $person->id }}" selected>{{ $person->name }}</option>
                    @else
                        <option value="{{ $person->id }}">{{ $person->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        {{-- Actor --}}
        <div class="mb-3">
            <label for="character_id">Actor</label>
            <select class="form-select" name="character_id" value="{{ old('character_id') }}">
                @foreach ($characters as $chara)
                    @if (old('character_id', $actor->character_id) == $chara->id)
                        <option value="{{ $chara->id }}" selected>
                            {{ Str::words($chara->name, 2, '') }}
                        </option>
                    @else
                        <option value="{{ $chara->id }}">
                            {{ Str::words($chara->name, 2, '') }}
                        </option>
                    @endif
                @endforeach
            </select>

            @error('character_id')
                <div class="alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Staff Role</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" 
             id="name" name="name" value="{{ old('name', $actor->name) }}" autofocus>
             @error('name')
                 <div class="invalid-feedback">
                     {{ $message }}
                 </div>
             @enderror
        </div>

        <div class="mb-3">
            @error('person_id')
                <div class="alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div> <!--// close of Form div //-->

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