{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')

{{-- Trix Text Editor --}}
<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/trix.css">
<script type="text/javascript" src="{{ URL::to('/') }}/js/trix.js"></script>
{{-- Trix Hide Upload --}}
<style> 
trix-toolbar [data-trix-button-group="file-tools"]{
  display:none;
}
</style>

<link rel="stylesheet" href="{{ URL::to('/') }}/css/setting.css">
<div class="container">
<!-- Tabs with Background on Card -->
	<!-- Nav tabs -->
	<div class="card" style="margin-top: 25px">
		<div class="card-header">
		<nav>
			<div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
			<a href="/setting/picture" class="button nav-link">Foto</a>
			<button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
				Profil</button>
			
			
			</div>
		</nav>
		</div>

		<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
			<form action="/setting/profile" method="post" class="edit-form">
				@method('put')
				@csrf
			<div class="row">  
				{{-- Name --}}
				<div class="col-md-3">
					<div class="card-body">
					<h5 style="margin-left:25px">Nama</h5>
					</div>
				</div>
				<div class="col-md-9">
					<div class="card-body">
					<h5>Nama Baru</h5>
						<div class="input-group flex-nowrap input-group-lg" style="padding-right: 30%">
						<input type="text" name="name" id="name"class="form-control"
						value="{{ old('name', $user->name) }}" autofocus>
						</div>
						@error('name')
							<div class="text-danger">
								{{ $message }}
							</div>
						@enderror
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
					<h5>Email Baru</h5>
						<div class="input-group flex-nowrap input-group-lg" style="padding-right: 30%">
						<input type="email" name="email" id="email" class="form-control"
						value="{{ old('email', $user->email) }}">
						</div>
						@error('email')
							<div class="text-danger">
								{{ $message }}
							</div>
						@enderror
					</div>
				</div>
				{{-- Biography --}}
				<div class="col-md-3">
					<div class="card-body">
					<h5 style="margin-left:25px">Biografi</h5>
					</div>
				</div>
				<div class="col-md-9">
					<div class="card-body">
					<h5>Biografi Baru</h5>
						<div class="" style="padding-right: 30%">
						<input id="biography" type="hidden" name="biography" value="{{ old('biography', $user->biography) }}">
						
						<trix-editor input="biography"></trix-editor>
						@error('biography')
							<small><span> {{ $message }} </span></small>
						@enderror
						</div>
					</div>
				</div>
				<div class="col-md-9 offset-md-3">
					<div class="card-body text-end" style="padding-right: 30%">
						<button type="submit" class="btn solid btn-primary">Perbarui</button>
					</div>
				</div>   
			</div>
			</form>
		</div>
		</div>

	</div>
<!-- End Tabs on plain Card -->
</div>

@endsection