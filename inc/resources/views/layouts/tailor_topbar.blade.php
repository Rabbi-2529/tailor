{{--
    Shared top bar for every panel.
    Expects: $tl_panel (small label above the name), $tl_role (shown under the user name), $tl_avatar (image url)
--}}
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav align-items-center">
        <li class="nav-item">
            <a class="nav-link tl-toggle" data-widget="pushmenu" href="#" role="button" title="Toggle menu"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-md-block tl-topbar-title">
            <span class="tl-topbar-eyebrow">{{ $tl_panel }}</span>
            <span class="tl-topbar-name">{{ Auth::user()->its_username }}</span>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto align-items-center">
        <li class="nav-item d-none d-lg-block tl-topbar-date">
            <i class="far fa-calendar-alt"></i>{{ now()->format('l, d M Y') }}
        </li>
        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle tl-user-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ $tl_avatar }}" class="tl-avatar" alt="User Image" onerror="this.onerror=null;this.src='{{ asset('assets/dist/img/avatar04.png') }}'">
                <span class="tl-user-meta d-none d-sm-block">
                    <strong>{{ Auth::user()->its_username }}</strong>
                    <small>{{ $tl_role }}</small>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right tl-dropdown">
                <div class="tl-dropdown-head">
                    <img src="{{ $tl_avatar }}" class="tl-avatar" alt="User Image" onerror="this.onerror=null;this.src='{{ asset('assets/dist/img/avatar04.png') }}'">
                    <div>
                        <strong>{{ Auth::user()->its_username }}</strong>
                        <small>Member since {{ Auth::user()->its_submit_at->format('d M Y') }}</small>
                    </div>
                </div>
                <a href="" class="dropdown-item"><i class="far fa-user"></i> Profile</a>
                <div class="dropdown-divider m-0"></div>
                <a href="{{ route('logout') }}" class="dropdown-item tl-signout"><i class="fas fa-sign-out-alt"></i> Sign out</a>
            </div>
        </li>
    </ul>
</nav>
