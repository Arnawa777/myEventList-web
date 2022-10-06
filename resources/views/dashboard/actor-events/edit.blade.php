{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')


@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-3 border-bottom"
style="padding: 30px 0px 20px 0px">
    <h2>Edit Assigned Actor</h2>
</div>

<div class="col-lg-8">
    {{-- otomatis ke store karena menggunakan resource --}}
    <form method="post" action="/dashboard/actor-events/{{ $actor_events->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf

        {{-- Event --}}
        <div class="mb-3">
            <label for="event_id">Event</label>
            <select class="form-select" id="event" name="event_id" value="{{ old('event_id') }}">
                @foreach ($events as $event)
                    @if (old('event_id', $actor_events->event_id) == $event->id)
                        <option value="{{ $event->id }}" selected>{{ $event->name }}</option>
                    @else
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        {{-- Actor --}}
        <div class="mb-3">
            <label for="actor_id">Actor</label>
            <select class="form-select" name="actor_id" value="{{ old('actor_id') }}">
                @foreach ($actors as $actor)
                    @if (old('actor_id', $actor_events->actor_id) == $actor->id)
                        <option value="{{ $actor->id }}" selected>
                            Character: {{ Str::words($actor->chara_name, 2, '') }}
                                &nbsp;&nbsp;&nbsp;───&nbsp;&nbsp;&nbsp;
                            Person: {{ $actor->person_name }}
                        </option>
                    @else
                        <option value="{{ $actor->id }}">
                            Character: {{ Str::words($actor->chara_name, 2, '') }}
                                &nbsp;&nbsp;&nbsp;───&nbsp;&nbsp;&nbsp;
                            Person: {{ $actor->person_name }}
                        </option>
                    @endif
                @endforeach
            </select>

            @error('actor_id')
                <div class="alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- Role --}}
        <div class="mb-3">
            <label for="role">Character Role</label>
            <select class="form-select" name="role" value="{{ old('role') }}">
                    @if (old('role', $actor->role))
                        <option {{ old('role', $actor->role) == 'Main' ? 'selected' : '' }}  value="Main">Main</option>
                        <option {{ old('role', $actor->role) == 'Support' ? 'selected' : '' }}  value="Support">Support</option>
                    @else
                        <option value="Main">Main</option>
                        <option value="Support">Support</option>
                    @endif
            </select>
                @error('role')
                    <div class="alert-danger">
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
            <button name="action" value="cancel" id="btn-cancel">Cancel</button>
            <button type="submit" name="action" value="update" id="btn-reply">Update</button>
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