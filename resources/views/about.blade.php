
{{-- ambil dari halaman layouts/main --}}
@extends('layouts.main')

{{-- isi dari layouts/main --}}
@section('container')

    <div class="container">
        <h1>Tentang Saya </h1>
    <h3>{{ $name }}</h3>
    <p><{{ $email }}></p>
    <img src="img/{{ $image }} " alt="{{ $name }}" width="200" class="img-thumbnail rounded-circle">
    </div>
    
@endsection


