<nav class="navbar navbar-expand-lg">
    <div class="container" id="my-navbar">    
			<a class="navbar-brand" href="/"><b>SanggarJogja</b></a> 
			<div class="collapse navbar-collapse justify-content-start">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a href="/events" class="nav-link">Komunitas</a>
					</li>
					{{-- Forum --}}
					<li class="nav-item">
						<a href="/forum" class="nav-link">Forum</a>
					</li>
					{{-- Other --}}
					<div class="collapse navbar-collapse">
						<ul class="navbar-nav">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									Lainnya
								</a>
								<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
									<li><a class="dropdown-item" href="/users">User</a></li>
									<li><a class="dropdown-item" href="/people">Orang</a></li>
									<li><a class="dropdown-item" href="/characters">Karakter</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</ul
			</div>
			
			<div class="collapse navbar-collapse navbar-nav justify-content-lg-end">
				
				<form action="/search">
					<div class="input-group" style="padding-right:20px">
					<input type="text" class="form-control" placeholder="Search.." 
					name="search" value="" id="deleteInput">
					<button class="btn btn-primary" type="submit" ><i class="bi bi-search"></i></button>
					</div>
				</form>

				{{-- Use AppServiceProvider --}}
				@admin
					<div class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" 
						role="button" aria-expanded="false"> {{ auth()->user()->username }}</a>
						<ul class="dropdown-menu dropdown-menu-dark">
							<li><a class="dropdown-item" href="/profile/{{ auth()->user()->username }}">Profile</a></li>
							<li><a class="dropdown-item" href="/setting/profile">Setting</a></li>
							<li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
							<li><hr class="dropdown-divider"></li>
							<li>
								<form action="/logout" method="POST">
									@csrf
									<button type="submit" class="dropdown-item">
									Logout
									</button>
								</form>
							</li>
						</ul>
					</div>
					<a href="/profile/{{ auth()->user()->username }}" >
						<img src="/storage/user-picture/{{ auth()->user()->picture }}" alt="avatar" style="object-fit: cover; width: 32px; height:32px" class="rounded-circle">
					</a>
				@endadmin

				{{-- Use AppServiceProvider --}}
				@user
					<div class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" 
						role="button" aria-expanded="false"> {{ auth()->user()->username }}</a>
						<ul class="dropdown-menu dropdown-menu-dark">
							<li><a class="dropdown-item" href="/profile/{{ auth()->user()->username }}">Profile</a></li>
							<li><a class="dropdown-item" href="/setting/profile">Setting</a></li>
							<li><hr class="dropdown-divider"></li>
							<li>
								<form action="/logout" method="POST">
									@csrf
									<button type="submit" class="dropdown-item">
									Logout
									</button>
								</form>
							</li>
						</ul>
					</div>
					<a href="/profile/{{ auth()->user()->username }}">
						<img src="/storage/user-picture/{{ auth()->user()->picture }}" alt="avatar" style="object-fit: cover; width: 32px; height:32px" class="rounded-circle">
					</a>
				@enduser

				@guest
					<a href="/login" class="btn btn-outline-dark me-2">Login</a>
				@endguest	
			</div>
    	
	</div>
</nav>