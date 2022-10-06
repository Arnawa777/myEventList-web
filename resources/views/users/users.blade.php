{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
    
<div class="container">
    <div class="row">
        <div style="display: flex; justify-content: center;">
            <div class="col-lg-6">
                <h1 class="mb-3 text-center" style="padding-top: 20px">{{ $title }}</h1>
                <form action="/users">
                    <div class="input-group mb-3" style="justify-content: center;">
                        <input type="text" class="form-control" placeholder="Search.." 
                        name="search" value="{{ request('search') }}" id="deleteInputLong">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        @foreach ($users as $user)
        <div class="col-lg-4" style="padding: 20px 10px">
                <div class="card" >
                    <a href="/profile/{{ $user->username }}">
                        <img src="/storage/user-picture/{{ $user->picture }}" class="card-img-top" style="height:20rem; object-fit: cover;" alt="{{ $user->username }}">
                    </a>
                    <div class="card-body">
                        <h5>
                            <a href="/profile/{{ $user->username }}" class="text-decoration-none text-dark">{{ $user->username }}</a>
                        </h5>
                    </div>
                    <div class="card-footer text-muted">
                        <p>Joined Date : {{ $user->created_at->format('d F Y'); }}</p>
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