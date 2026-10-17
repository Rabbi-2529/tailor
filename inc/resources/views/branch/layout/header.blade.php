@include('layouts.tailor_topbar', [
    'tl_panel'  => 'Branch Panel',
    'tl_role'   => 'Branch Manager',
    'tl_avatar' => asset('').Auth::user()->BranchDetailsUser->its_branch_com_logo,
])
