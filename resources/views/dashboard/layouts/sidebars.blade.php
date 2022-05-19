<link rel="stylesheet" href="{{asset('../css/sidebar.css')}}">
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block side-nav collapse">
<div class=" position-sticky pt-3">
  <a href="/">
      <h1>MyEventList</h1>
  </a>
  <ul >
      <li class="first-item {{ Request::is('dashboard') ? 'active' : '' }}"><a href="/dashboard">
          <img src="../../icon/home.svg" class="icon" alt="icon-home">
          <p>Dashboard</p></a>
      </li>
      <li class="first-item {{ Request::is('dashboard/events*') ? 'active' : '' }}"><a href="/dashboard/events">

          <img src="../../icon/event.svg" class="icon" alt="icon-event">
          <p>Events</p></a>
      </li>
      <li class="second-item"><a href="#">
          <img src="../../icon/corner-down-right.svg" class="icon" alt="icon-corner-right">
          <p>Categories</p></a>
      </li>
      <li><a href="#">
          <img src="../../icon/discuss.svg" class="icon" alt="icon-post">
          <p>Posts</p></a>
      </li>
      <li class="second-item"><a href="#">
          <img src="../../icon/corner-down-right.svg" class="icon" alt="icon-corner-right">
          <p>Topics</p></a>
      </li>
      <li><a href="#">
          <img src="../../icon/girl.svg" class="icon" alt="icon-person">
          <p>People</p></a>
      </li>
      <li class="second-item"><a href="#">
          <img src="../../icon/corner-down-right.svg" class="icon" alt="icon-corner-right">
          <p>Roles</p></a>
      </li>
      <li><a href="#">
          <img src="../../icon/icon-wayang.svg" class="icon" alt="icon-character">
          <p>Character</p></a>
      </li>
      <li><a href="#">
          <img src="../../icon/map-pin.svg" class="icon" alt="icon-location">    
          <p>Location</p></a>
      </li>
  </ul>
</div>
</nav>
