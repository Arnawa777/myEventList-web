<link rel="stylesheet" href="{{asset('../css/sidebar.css')}}">
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block side-nav collapse">
<div class=" position-sticky pt-3">
  <a href="/">
      <h1>SanggarJogja</h1>
  </a>
  <ul >
      <li class="first-item {{ Request::is('dashboard') ? 'active' : '' }}"><a href="/dashboard">
          <img src="{{ URL::to('/') }}/icon/home.svg" class="icon" alt="icon-home">
          <p>Dashboard</p></a>
      </li>
      <li class="first-item {{ Request::is('dashboard/events*') ? 'active' : '' }} {{ Request::is('dashboard/categories*') ? 'active' : '' }} {{ Request::is('dashboard/actor-events*') ? 'active' : '' }} {{ Request::is('dashboard/staff*') ? 'active' : '' }}"><a href="/dashboard/events">
          <img src="{{ URL::to('/') }}/icon/event.svg" class="icon" alt="icon-event">
          <p>Komunitas</p></a>
      </li>
      <li class="second-item {{ Request::is('dashboard/categories*') ? 'active' : '' }}"><a href="/dashboard/categories">
          <img src="{{ URL::to('/') }}/icon/corner-down-right.svg" class="icon" alt="icon-corner-right">
          <p>Kategori</p></a>
      </li>
      <li class="second-item {{ Request::is('dashboard/actor-events*') ? 'active' : '' }}"><a href="/dashboard/actor-events">
        <img src="{{ URL::to('/') }}/icon/corner-down-right.svg" class="icon" alt="icon-corner-right">
        <p>Tetapkan Aktor</p></a>
    </li>
    <li class="second-item {{ Request::is('dashboard/staff*') ? 'active' : '' }}"><a href="/dashboard/staff">
        <img src="{{ URL::to('/') }}/icon/corner-down-right.svg" class="icon" alt="icon-corner-right">
        <p>Tetapkan Staf</p></a>
    </li>
      <li class="first-item {{ Request::is('dashboard/posts*') ? 'active' : '' }} {{ Request::is('dashboard/topics*') ? 'active' : '' }}"><a href="/dashboard/posts">
          <img src="{{ URL::to('/') }}/icon/discuss.svg" class="icon" alt="icon-post">
          <p>Post</p></a>
      </li>
      <li class="second-item {{ Request::is('dashboard/topics*') ? 'active' : '' }}"><a href="/dashboard/topics">
          <img src="{{ URL::to('/') }}/icon/corner-down-right.svg" class="icon" alt="icon-corner-right">
          <p>Topik</p></a>
      </li>
      <li class="first-item {{ Request::is('dashboard/people*') ? 'active' : '' }} {{ Request::is('dashboard/actors*') ? 'active' : '' }}"><a href="/dashboard/people">
          <img src="{{ URL::to('/') }}/icon/girl.svg" class="icon" alt="icon-person">
          <p>Orang</p></a>
      </li>
      <li class="second-item {{ Request::is('dashboard/actors*') ? 'active' : '' }}"><a href="/dashboard/actors">
          <img src="{{ URL::to('/') }}/icon/corner-down-right.svg" class="icon" alt="icon-corner-right">
          <p>Aktor</p></a>
      </li>
      <li class="first-item {{ Request::is('dashboard/characters*') ? 'active' : '' }}"><a href="/dashboard/characters">
          <img src="{{ URL::to('/') }}/icon/icon-wayang.svg" class="icon" alt="icon-character">
          <p>Karakter</p></a>
      </li>
      <li class="first-item {{ Request::is('dashboard/locations*') ? 'active' : '' }}"><a href="/dashboard/locations">
          <img src="{{ URL::to('/') }}/icon/map-pin.svg" class="icon" alt="icon-location">    
          <p>Lokasi</p></a>
      </li>
  </ul>
</div>
</nav>
