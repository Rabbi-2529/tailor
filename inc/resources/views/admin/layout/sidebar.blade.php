<aside class="tl-sidebar">
    @include('layouts.tailor_brand', ['tl_home' => route('admin.dash')])

    <div class="tl-sidebar-body">
      <div class="tl-user-card">
        <div class="image">
          <img src="{{ asset('assets/dist/img/avatar5.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->its_username }}</a>
          <small>Super Admin</small>
        </div>
      </div>

      <nav class="tl-nav">
        <ul class="tl-menu" role="menu">
          <li class="nav-item has-treeview @yield('dashboard')">
            <a href="{{ route('admin.dash') }}" class="nav-link @yield('dashboard_link')">
              <i class="nav-icon fas fa-th-large"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-header">COMPANIES</li>
          <li class="nav-item @yield('com_reg_class')">
            <a href="{{ route('admin.company-registration') }}" class="nav-link @yield('com_reg_link')">
              <i class="nav-icon fas fa-building"></i>
              <p>Company Registration</p>
            </a>
          </li>
          <li class="nav-item @yield('com_list_class')">
            <a href="{{ route('admin.company-list') }}" class="nav-link @yield('com_list_link')">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>Company List</p>
            </a>
          </li>

          <li class="nav-header">BRANCHES</li>
          <li class="nav-item @yield('branch_reg_class')">
            <a href="{{ route('admin.branch-registration') }}" class="nav-link @yield('branch_reg_link')">
              <i class="nav-icon fas fa-store"></i>
              <p>Branch Registration</p>
            </a>
          </li>
          <li class="nav-item @yield('branch_list_class')">
            <a href="{{ route('admin.branch-list') }}" class="nav-link @yield('branch_list_class_link')">
              <i class="nav-icon fas fa-store-alt"></i>
              <p>Branch List</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
</aside>
