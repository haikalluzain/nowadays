<?php 
  $route = Route::currentRouteName();
?>

<div class="main-sidebar sidebar-style-2 shadow">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="dashboard-ecommerce.html">Nowadays</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="dashboard-ecommerce.html">NW</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="{{ ($route == 'dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

      <li class="{{ ($route == 'dashboard.full') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard.full') }}" target="blank"><i class="fas fa-tv"></i> <span>Full-tv Dashboard</span></a></li>

      <li class="menu-header">Content</li>
      
      <li class="dropdown {{ ($route == 'today.list' || $route == 'today.date') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="far fa-square"></i> <span>Jadwal</span></a>
        <ul class="dropdown-menu">
          <li class="{{ ($route == 'today.list') ? 'active' : '' }}"><a class="nav-link" href="{{ route('today.list') }}">Hari ini</a></li>
          <li class="{{ ($route == 'today.date') ? 'active' : '' }}"><a class="nav-link" href="{{ route('today.date') }}">Semua hari</a></li>
        </ul>
      </li>

      <li class="dropdown {{ ($route == 'major.index' || $route == 'rombel.index' || $route == 'attendance.index' || $route == 'major.edit' || $route == 'rombel.edit' || $route == 'attendance.edit' || $route == 'major.create' || $route == 'rombel.create' || $route == 'attendance.create') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="far fa-square"></i> <span>Absensi</span></a>
        <ul class="dropdown-menu">
          <li class="{{ ($route == 'major.index' || $route == 'major.create' || $route == 'major.edit') ? 'active' : '' }}"><a class="nav-link" href="{{ route('major.index') }}">Jurusan</a></li>
          <li class="{{ ($route == 'rombel.index' || $route == 'rombel.create' || $route == 'rombel.edit') ? 'active' : '' }}"><a class="nav-link" href="{{ route('rombel.index') }}">Rombel</a></li>
          <li class="{{ ($route == 'attendance.index' || $route == 'attendance.create' || $route == 'attendance.edit') ? 'active' : '' }}"><a class="nav-link" href="{{ route('attendance.index') }}">Absen Hari Ini</a></li>
        </ul>
      </li>

      <li class="{{ ($route == 'event.calendar') ? 'active' : '' }}"><a class="nav-link" href="{{ route('event.calendar') }}"><i class="far fa-calendar-alt"></i> <span>Kalender Kegiatan</span></a></li>

      <li class="{{ ($route == 'thumbnail.index' || $route == 'thumbnail.create' || $route == 'thumbnail.edit' || $route == 'thumbnail.active' || $route == 'thumbnail.inactive') ? 'active' : '' }}"><a class="nav-link" href="{{ route('thumbnail.index') }}"><i class="far fa-image"></i> <span>Thumbnail</span></a></li>
      
    </ul>
  </aside>
</div>