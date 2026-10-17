<aside class="tl-sidebar">
    @include('layouts.tailor_brand', ['tl_home' => route('company.dashboard')])

    <div class="tl-sidebar-body">
      <div class="tl-user-card">
        <div class="image">
          <img src="{{ asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->its_username }}</a>
          <small>Company Owner</small>
        </div>
      </div>

      <nav class="tl-nav">
        <ul class="tl-menu" role="menu">
          <li class="nav-item has-treeview @yield('dashboard')">
            <a href="{{ route('company.dashboard') }}" class="nav-link @yield('dashboard_link')">
              <i class="nav-icon fas fa-th-large"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-header">BRANCHES</li>
          <li class="nav-item has-treeview @yield('branch_reg')">
            <a href="{{ route('company.branch-registration') }}" class="nav-link @yield('branch_reg_link')">
              <i class="nav-icon fas fa-store"></i>
              <p>Branch Registration</p>
            </a>
          </li>
          <li class="nav-item has-treeview @yield('branch_list')">
            <a href="{{ route('company.branch-list') }}" class="nav-link @yield('branch_list_link')">
              <i class="nav-icon fas fa-store-alt"></i>
              <p>Branch List</p>
            </a>
          </li>

          <li class="nav-header">SETTINGS</li>
          <li class="nav-item has-treeview @yield('balance')">
            <a href="{{ route('company.balance') }}" class="nav-link @yield('balance_link')">
              <i class="nav-icon fas fa-wallet"></i>
              <p>Balance</p>
            </a>
          </li>
          <li class="nav-item has-treeview @yield('sms')">
            <a href="{{ route('company.sms-setup') }}" class="nav-link @yield('sms_setup_link')">
              <i class="nav-icon fas fa-sms"></i>
              <p>SMS Setup</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
</aside>
