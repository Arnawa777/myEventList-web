{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
    
<div class="container">
    <div class="row">
        @foreach ($users as $user)
            <div class="col-sm-4 mb-3">
                <div class="card">
                    <img src="/storage/user-picture/{{ $user->picture }}" class="card-img-top" style="height:20rem; object-fit: cover;" alt="{{ $user->username }}">
                    <div class="card-body">
                    <h5 class="card-title">
                        <a href="/profile/{{ $user->username }}" class="text-decoration-none text-dark">{{ $user->username }}</a>
                    </h5>
                    <p class="card-text">
                        @if (is_null($user->bio))
                           <p> This user doesn't have biography yet... </p>
                        @else
                            {!!  Str::limit($user->bio, 50, $end='...')  !!}
                        @endif
                    </p>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection