{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
    
<div class="container">
    <div class="row">
        @foreach ($users as $user)
        <div class="col-lg-4" style="padding: 20px 10px">
                <div class="card" >
                    <img src="/storage/user-picture/{{ $user->picture }}" class="card-img-top" style="height:20rem; object-fit: cover;" alt="{{ $user->username }}">
                    <div class="card-body">
                        <h5>
                            <a href="/profile/{{ $user->username }}" class="text-decoration-none text-dark">{{ $user->username }}</a>
                        </h5>
                    </div>
                    <div class="card-footer text-muted">
                        2 days ago
                    </div>
                </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-end">
		{{ $users->links('vendor.pagination.custom') }}
	</div>
</div>

@endsection