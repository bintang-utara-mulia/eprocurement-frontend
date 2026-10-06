<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
      <div class="d-sm-none d-lg-inline-block">Halo, {{ auth()->user()->name ?? 'User' }} | <form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf<button class="btn btn-link p-0">Logout</button></form></div></a>
    </li>
  </ul>
</nav>