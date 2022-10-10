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
<script src=""></script>
<div class="container">
<!-- Tabs with Background on Card -->
	<!-- Nav tabs -->
	<div class="card" style="margin-top: 25px">
		<div class="card-header">
		<nav>
			<div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
			<button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Foto</button>
			<a href="/setting/profile" class="button nav-link">Profil</a>
			</div>
		</nav>
		</div>

		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				<div class="row">
				<div class="col-md-4">


					<div class="card-body text-center">
						@if ($user->picture)
							<img class="profile-preview" src="/storage/user-picture/{{ $user->picture }}">
						@else
							<img class="profile-preview">
						@endif
					</div>
				</div>
				<div class="col-md-8">
					<div class="card-body">
						<h4>Unggah Foto</h4>
						<p>Harus Gambar dengan ukuran maksimal 2 MB</p>
						@error('picture')
				<div class="text-danger">
					{{ $message }}
				</div>
				@enderror
						<form action="/setting/picture" method="post" enctype="multipart/form-data">
							@method('put')
							@csrf
							<input type="hidden" name="oldPicture" value="{{ $user->picture }}">
							<input type="file" name="picture" id="picture" onchange="previewImage()">
							<button type="submit" class="btn-sub btn btn-primary" style="margin-top:10px">Unggah</button>
				
						</form>
				
					</div>
					<div class="card-body">
					<h4>Hapus Foto</h4>
					<p>Anda dapat menghapus foto ini dengan mengklik tombol di bawah ini. Jangan lupa untuk mengunggah yang lain, atau Anda akan memiliki foto default sebagai gantinya..</p>
						
					<form action="/setting/picture" method="post" class="d-inline">
					@method('delete')
					@csrf
					<button class="btn btn-danger" onclick="return confirm('Apa anda yakin?')">Hapus</button>
					
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