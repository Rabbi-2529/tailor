{{--
    Shared top bar for every panel.
    Expects: $tl_panel (small label above the name), $tl_role (shown under the user name), $tl_avatar (image url)
--}}
@php
    $tl_avatar_fallback = asset('assets/dist/img/avatar04.png');
@endphp
<header class="tl-topbar">
    <button type="button" class="tl-toggle" data-tl-sidebar-toggle title="Toggle menu" aria-label="Toggle menu">
        <i class="fas fa-bars"></i>
    </button>
    <div class="tl-topbar-title d-none d-md-block">
        <span class="tl-topbar-eyebrow">{{ $tl_panel }}</span>
        <span class="tl-topbar-name">{{ Auth::user()->its_username }}</span>
    </div>

    <div class="tl-topbar-right">
        <div class="tl-topbar-date d-none d-lg-block">
            <i class="far fa-calendar-alt"></i>{{ now()->format('l, d M Y') }}
        </div>
        <div class="dropdown">
            <a href="#" class="dropdown-toggle tl-user-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ $tl_avatar }}" class="tl-avatar" alt="User Image" onerror="this.onerror=null;this.src='{{ $tl_avatar_fallback }}'">
                <span class="tl-user-meta d-none d-sm-block">
                    <strong>{{ Auth::user()->its_username }}</strong>
                    <small>{{ $tl_role }}</small>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right tl-dropdown">
                <div class="tl-dropdown-head">
                    <img src="{{ $tl_avatar }}" class="tl-avatar" alt="User Image" onerror="this.onerror=null;this.src='{{ $tl_avatar_fallback }}'">
                    <div>
                        <strong>{{ Auth::user()->its_username }}</strong>
                        <small>Member since {{ Auth::user()->its_submit_at->format('d M Y') }}</small>
                    </div>
                </div>
                <a href="" class="dropdown-item"><i class="far fa-user"></i> Profile</a>
                <div class="dropdown-divider m-0"></div>
                <a href="{{ route('logout') }}" class="dropdown-item tl-signout"><i class="fas fa-sign-out-alt"></i> Sign out</a>
            </div>
        </div>
    </div>
</header>
