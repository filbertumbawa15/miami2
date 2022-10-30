<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-miami sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon">
      <img src="{{asset('guest/images/logo.png')}}" class="login-icon">
    </div>
    <div class="slogan">MIAMI CASINO 4D</div>
    <!-- <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div> -->
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item {{ Request::is(['admin/', 'admin/dashboard']) ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Content
  </div>

  <li class="nav-item {{ Request::is('admin/result') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.result.index') }}">
      <i class="fas fa-fw fa-chart-area"></i>
      <span>Result</span></a>
  </li>
</ul>
<!-- End of Sidebar -->