{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')
    
<div class="container mt-4">
    <div class="row">
        <div class="col-sm-4">
          <div class="card">
            <img class="img-fluid"  src="/storage/user-picture/{{ $user->picture }}" style="width:100%; height:300px; object-fit: cover;">
            <div class="card-body">
                <h3>
                    @if (is_null($user->name))
                        {{ $user->username }}'s Profile
                    @else
                        {{ Str::words($user->name, 2, '') }}'s Profile
                    @endif
                    <br>
                    {{-- Cek profile yang dibuka merupakan user yang sedang login --}}
                    @if (auth()->user() == $user)
                      <a href="/setting">Edit Profile</a>
                    @endif
                </h3>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Last Online 1 Minutes Ago</li>
                <li class="list-group-item">Joined date : {{ $user->created_at->format('d F Y'); }}</li>
              </ul>
              <div class="card-body">
                <a href="">
                  <button>Event List</button>
                </a>
              </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            {{-- Name --}}
            <div class="card-body">
              <h5 class="card-title">Name</h5>
                <p class="card-text">
                  @if (is_null($user->name))
                     <p> This user doesn't have name yet... </p>
                  @else
                      {!! $user->name !!}
                  @endif
              </p>
            </div>
            {{-- Bio --}}
            <div class="card-body">
              <h5 class="card-title">Bio</h5>
                <p class="card-text">
                  @if (is_null($user->bio))
                     <p> This user doesn't have biography yet... </p>
                  @else
                      {!! $user->bio !!}
                  @endif
              </p>
            </div>
          </div>
        </div>
      </div>
    
</div>

@endsection