<nav class="navbar navbar-expand-lg">
    <div class="container">    
      <a class="navbar-brand" href="/"><b>MyEventList</b></a>
      {{-- Hamburger for Phone --}}
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
     
      <div class="collapse navbar-collapse justify-content-lg-start" id="navbarNav">
        
        <ul class="navbar-nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-start mb-md-0">
          <li class="nav-item">
            <a class="nav-link {{ request()->segment(1) == '' ? 'active' : '' }}" href="/events">Event</a>
          </li>
          {{-- Community --}}
          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Community
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                  <li><a class="dropdown-item" href="/forum">Forums</a></li>
                  <li><a class="dropdown-item" href="/users">Users</a></li>
                </ul>
              </li>
            </ul>
          </div>
          {{-- Other --}}
          <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Other
                </a>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                  <li><a class="dropdown-item" href="/people">People</a></li>
                  <li><a class="dropdown-item" href="/characters">Characters</a></li>
                  <li><a class="dropdown-item" href="/about">About</a></li>
                </ul>
              </li>
            </ul>
          </div>
          </ul
        
      </div>

      
      <div class="collapse navbar-collapse navbar-nav justify-content-lg-end" id="navbarNav">
        {{-- Use AppServiceProvider --}}
        @admin
          <form class=" col-12 col-lg-4 mb-3 mb-lg-0 me-lg-3">
            <div class="input-group">
              <input type="search" class="form-control" placeholder="Search" aria-label="Search">
              <div class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                  <i class="bi bi-search"></i>
                </button>
              </div>
            </div>
          </form>
          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" 
            role="button" aria-expanded="false"> {{ auth()->user()->username }}</a>
            <ul class="dropdown-menu">
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
          <a href="/profile/{{ auth()->user()->username }}"" >
            <img src="/storage/user-picture/{{ auth()->user()->picture }}" alt="avatar" style="object-fit: cover; width: 32px; height:32px" class="rounded-circle">
          </a>
        @endadmin
        {{-- Use AppServiceProvider --}}
        @user
          <form class="col-12 col-lg-3 mb-3 mb-lg-0 me-lg-3">
            <div class="input-group">
              <input type="search" class="form-control" placeholder="Search" aria-label="Search">
              <div class="input-group-btn">
                <button class="btn btn-primary" type="submit">
                  <i class="bi bi-search"></i>
                </button>
              </div>
            </div>
          </form>
          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" 
            role="button" aria-expanded="false"> {{ auth()->user()->username }}</a>
            <ul class="dropdown-menu">
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
          <a href="/profile/{{ auth()->user()->username }}"" >
            <img src="/storage/user-picture/{{ auth()->user()->picture }}" alt="avatar" style="object-fit: cover; width: 32px; height:32px" class="rounded-circle">
          </a>
        @enduser

        @guest
          <link rel="stylesheet" href="">
          <a href="/login" class="btn btn-outline-dark me-2">Login</a>
        @endguest
        
      </div>
    </div>
  </nav>