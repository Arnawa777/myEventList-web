{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
style="padding: 30px 0px 20px 0px">
    <h2>Create New Actor</h2>
</div>

<div class="col-lg-8">
    {{-- otomatis ke store karena menggunakan resource --}}
    <form method="post" action="/dashboard/actors/" enctype="multipart/form-data">
        @csrf

        {{-- Person --}}
        <div class="mb-3">
            <label for="person_id">Person</label>
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

        {{-- Character --}}
        <div class="mb-3">
            <label for="character_id">Character</label>
            <select class="form-select" name="character_id" value="{{ old('character_id') }}">
                @foreach ($characters as $chara)
                    @if (old('character_id') == $chara->id)
                        <option value="{{ $chara->id }}" selected>
                            {{ $chara->name }} - {{ $chara->role }}
                        </option>
                    @else
                        <option value="{{ $chara->id }}">
                            {{ $chara->name }} - {{ $chara->role }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            @error('character_id')
                <div class="alert-danger">
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