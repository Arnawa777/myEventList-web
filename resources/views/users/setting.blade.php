{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')

<link rel="stylesheet" href="{{asset('../css/setting.css')}}">
  <div class="container">
    <!-- Tabs with Background on Card -->
        <!-- Nav tabs -->
        <div class="card" style="margin-top: 25px">
          <div class="card-header">
            <nav>
              <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
              </div>
            </nav>
          </div>

          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <div class="row">
                <div class="col-md-4">
                  <div class="card-body text-center">
                    <img class="img-fluid" src="/storage/user-picture/{{ $user->picture }}" style="width:250px; height:250px; object-fit: cover;  border-radius:50%;">
                  </div>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                      <h4>Upload Image</h4>
                      <p>Must be jpg, jpeg or png format. No NSFM allowed. No copyrighted images.
                        Maximum of 225 x 350 pixels (resized automatically).</p>
                      @error('image')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        <br>
                      @enderror
                      
                      <form action="/setting" method="POST" enctype="multipart/form-data">
                          @csrf
                          <input type="file" name="image" id="image">
                          <input type="submit" value="Upload">
                      </form>
                    </div>
                  <div class="card-body">
                    <h4>Remove Image</h4>
                      <p>You can remove this picture by clicking the button below. Don't forget to upload another though, or else you will have an default image in its place..</p>
                      <form action="/setting" method="POST" enctype="multipart/form-data">
                          @csrf
                          <button class="btn btn-danger">Blom Jalan</button>
                      </form>
                  </div>
                </div>
              </div> 
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
              <div class="row">
                {{-- Name --}}
                <div class="col-md-3">
                  <div class="card-body">
                  <h5 style="margin-left:25px">Name</h5>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="card-body">
                    <h5>New Name <i class="fas fa-user"></i></h5>
                      <div class="input-group flex-nowrap input-group-lg" style="padding-right: 30%">
                        <input type="text" name="username" id="username" autofocus class="form-control">
                        @error('username')
                            <small><span> {{ $message }} </span></small>
                        @enderror
                      </div>
                  </div>
                </div>
                {{-- Email --}}
                <div class="col-md-3">
                  <div class="card-body">
                  <h5 style="margin-left:25px">Email</h5>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="card-body">
                    <h5>New Email <i class="fas fa-user"></i></h5>
                      <div class="input-group flex-nowrap input-group-lg" style="padding-right: 30%">
                        <input type="email" name="email" id="email" autofocus class="form-control">
                        @error('email')
                            <small><span> {{ $message }} </span></small>
                        @enderror
                      </div>
                  </div>
                </div>
                {{-- Bio --}}
                <div class="col-md-3">
                  <div class="card-body">
                  <h5 style="margin-left:25px">Bio</h5>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="card-body">
                    <h5>New Bio <i class="fas fa-user"></i></h5>
                      <div class="input-group flex-nowrap input-group-lg" style="padding-right: 30%">
                        <textarea name="bio" id="bio" class="form-control" rows="5" aria-label="With textarea"></textarea>
                        @error('bio')
                            <small><span> {{ $message }} </span></small>
                        @enderror
                      </div>
                  </div>
                </div>
                <div class="col-md-9 offset-md-3">
                  <div class="card-body text-end" style="padding-right: 30%">
                    <form action="#" method="POST" class="edit-form">
                      @csrf
                      <input type="submit" value="Register" class="btn solid btn-primary" >
                    </form>
                  </div>
                </div>
              </div> 
            </div>
          </div>

        </div>
    <!-- End Tabs on plain Card -->
  </div>

@endsection