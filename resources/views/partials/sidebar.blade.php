<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ANTRIAN ONLINE</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Pasien -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/admin/pasien') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Pasien</span>
        </a>
        <a class="nav-link" href="{{ url('/admin/dokter') }}">
            <i class="fas fa-fw fa-user-md"></i>
            <span>Dokter</span>
        </a>
        <a class="nav-link" href="{{ url('/admin/jadwal-praktek') }}">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Jadwal Praktek</span>
        </a>
        <a class="nav-link" href="{{ url('/admin/antrian') }}">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Antrian</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Add more items as needed -->
</ul>