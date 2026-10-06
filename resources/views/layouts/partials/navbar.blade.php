<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown">
      <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <div class="d-sm-none d-lg-inline-block">Halo, {{ auth()->user()->name ?? 'User' }}</div>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-title">Aksi Akun</div>
        <div class="dropdown-divider"></div>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="dropdown-item has-icon text-danger d-flex align-items-center" style="cursor: pointer;">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </button>
        </form>
      </div>
    </li>
  </ul>
</nav>