{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
     style="padding: 30px 0px 20px 0px">
     <h2>Update Staff</h2>
</div>

<div class="col-lg-8">
    {{-- otomatis ke store karena menggunakan resource --}}
    <form method="post" action="/dashboard/staff/{{ $staff->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf

        {{-- Event --}}
        <div class="mb-3">
            <label for="event_id">Event</label>
            <select class="form-select" id="event" name="event_id" value="{{ old('event_id') }}">
                @foreach ($events as $event)
                    {{-- Mengambil old value --}}
                    @if (old('event_id', $staff->event_id) == $event->id)
                        <option value="{{ $event->id }}" selected>
                            {{ $event->name }}
                        
                        </option>
                    @else
                        <option value="{{ $event->id }}">
                            {{ $event->name }}
                        </option>
                    @endif  
                
                @endforeach
            </select>
        </div>

        {{-- Person --}}
        <div class="mb-3">
            <label for="person_id">Person</label>
            <select class="form-select" name="person_id" value="{{ old('person_id') }}">
                @foreach ($people as $person)
                    {{-- Mengambil old value --}}
                    @if (old('person_id', $staff->person_id) == $person->id)
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

        <div class="mb-3">
            <label for="role" class="form-label">Staff Role</label>
            <input type="text" class="form-control @error('role') is-invalid @enderror" 
                   id="role" name="role" value="{{ old('role', $staff->role) }}" autofocus>
            @error('role')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- TRIX Descriptionn --}}
        <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input id="description" type="hidden" name="description" 
                value="{{ old('description', $staff->description) }}">
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

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection