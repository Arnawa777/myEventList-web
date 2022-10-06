{{-- ambil dari halaman layouts/main --}}
@extends('dashboard.layouts.main')

@section('container')
<style>
	#homeDataParent{
		border: 2px black solid;
		margin: 5px;
		text-align:center;
		height: 200px;
	}

	#homeDataParentSecond{
		text-align:center;
		height: 225px;
	}

	#homeDataLeft{
		border: 2px black solid; 
		margin: 5px;
		margin-bottom: 0; 
		height:225px;
	}

	#homeDataRight{
		border: 2px black solid;
		margin: 0 5px;
		height: 100px;
	}

	#homeDataTitle{
		background: #0D74F5; 
		color:white;
		/* margin-bottom: 10px; */
		height: 40%;
		display: flex;
		justify-content: center;
		align-content: center;
		flex-direction: column;
	}

</style>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2">Welcome Back, {{ auth()->user()->username }}</h1>
</div>

<div class="row" id="homeDataParent">
	<div class="col-12" id="homeDataTitle">
		<h3>Event Data</h3>
	</div>
	<div class="col-3">
		<h5>Events</h5>
		<h3 class="numberCircle">{{ $events }}</h3>
	</div>
	<div class="col-3">
		<h5>Categories</h5>
		<h3>{{ $categories }}</h3>
	</div>
	<div class="col-3">
		<h5>Staff</h5>
		<h3>{{ $staff }}</h3>
	</div>
	<div class="col-3">
		<h5>Actors</h5>
		<h3>{{ $actors }}</h3>
	</div>
</div>

<div class="row" id="homeDataParent" style="margin-top: 10px;">
	<div class="col-12" id="homeDataTitle">
		<h3>Forum Data</h3>
	</div>
	<div class="col-6">
		<h5>Post</h5>
		<h3>{{ $posts }}</h3>
	</div>
	<div class="col-6">
		<h5>Topic</h5>
		<h3>{{ $topics }}</h3>
	</div>
</div>

<div class="row" id="homeDataParentSecond">
	<div class="col-6">
		<div class="row" id="homeDataLeft">
			<div class="col-12" id="homeDataTitle">
				<h3>Other Data</h3>
			</div>
			<div class="col-6">
				<h5>People</h5>
				<h3>{{ $people }}</h3>
			</div>
			<div class="col-6">
				<h5>Characters</h5>
				<h3>{{ $characters }}</h3>
			</div>
		</div>
	</div>
		
	<div class="col-6">
		<div class="row" id="homeDataRight" style="margin-top:5px; margin-bottom:25px;">
			<div class="col-12" id="homeDataTitle">
				<h3>User Data</h3>
			</div>
			<div class="col-12">
				<h3>{{ $users }}</h3>
			</div>
		</div>	
		<div class="row" id="homeDataRight" style="margin-bottom: 0;">
			<div class="col-12" id="homeDataTitle">
				<h3>Location Data</h3>
			</div>
			<div class="col-12">
				<h3>{{ $locations }}</h3>
			</div>
		</div>
		

	</div>
</div>
@endsection
