@include('layouts.tailor_topbar', [
    'tl_panel'  => 'Staff Panel',
    'tl_role'   => 'Staff',
    'tl_avatar' => empty(Auth::user()->UserDetails->its_user_pic)
        ? asset('assets/dist/img/avatar04.png')
        : asset('').'/'.Auth::user()->UserDetails->its_user_pic,
])
