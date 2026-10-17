@extends('branch.layout.master')
@section('dashboard','menu-open')
@section('dashboard_link','active')
@section('content')
@php
    $tl_hour = (int) now()->format('G');
    $tl_greeting = $tl_hour < 12 ? 'Good morning' : ($tl_hour < 17 ? 'Good afternoon' : 'Good evening');
@endphp
<section class="content">
    <div class="container-fluid">
        @if (session()->has('branch'))
        <div class="alert alert-success alert-dismissible fade show mt-3 mb-0" role="alert">
           {{ session()->get('branch') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        {{-- Welcome --}}
        <div class="tl-hero">
            <i class="fas fa-cut tl-hero-icon"></i>
            <div>
                <div class="tl-hero-eyebrow">Branch Dashboard</div>
                <h1>{{ $tl_greeting }}, {{ Auth::user()->its_username }}</h1>
                <p>{{ number_format($today_order) }} new {{ \Illuminate\Support\Str::plural('order', $today_order) }} today &middot; {{ number_format($processing) }} in the workshop</p>
            </div>
            <div class="tl-hero-actions">
                <a href="{{ route('branch.customer.customer-registration') }}" class="btn btn-ghost"><i class="fas fa-user-plus mr-1"></i> New Customer</a>
                <a href="{{ route('branch.OrderReport.order-list') }}" class="btn btn-gold"><i class="fas fa-clipboard-list mr-1"></i> Order Lists</a>
            </div>
        </div>

        {{-- Order stats --}}
        <div class="row">
            <div class="col-xl-3 col-sm-6 col-6">
                <a href="{{ route('branch.OrderReport.today-order') }}" class="tl-stat tl-accent-gold">
                    <span class="tl-stat-icon"><i class="fas fa-calendar-day"></i></span>
                    <span>
                        <span class="tl-stat-label d-block">Today's Orders</span>
                        <span class="tl-stat-value d-block">{{ number_format($today_order) }}</span>
                        <span class="tl-stat-hint">Received today</span>
                    </span>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 col-6">
                <a href="{{ route('branch.OrderReport.receive') }}" class="tl-stat tl-accent-teal">
                    <span class="tl-stat-icon"><i class="fas fa-inbox"></i></span>
                    <span>
                        <span class="tl-stat-label d-block">Received</span>
                        <span class="tl-stat-value d-block">{{ number_format($receive) }}</span>
                        <span class="tl-stat-hint">Waiting to be cut</span>
                    </span>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 col-6">
                <a href="{{ route('branch.OrderReport.processing') }}" class="tl-stat tl-accent-amber">
                    <span class="tl-stat-icon"><i class="fas fa-cut"></i></span>
                    <span>
                        <span class="tl-stat-label d-block">Processing</span>
                        <span class="tl-stat-value d-block">{{ number_format($processing) }}</span>
                        <span class="tl-stat-hint">With makers</span>
                    </span>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 col-6">
                <a href="{{ route('branch.OrderReport.total-order') }}" class="tl-stat tl-accent-navy">
                    <span class="tl-stat-icon"><i class="fas fa-clipboard-list"></i></span>
                    <span>
                        <span class="tl-stat-label d-block">Total Orders</span>
                        <span class="tl-stat-value d-block">{{ number_format($total_order) }}</span>
                        <span class="tl-stat-hint">All time</span>
                    </span>
                </a>
            </div>
        </div>

        <div class="row">
            {{-- Recent orders --}}
            <div class="col-xl-8">
                @include('layouts.tailor_recent_orders', [
                    'tl_com' => Auth::user()->BranchDetailsUser->its_branch_com_id,
                    'tl_bran' => Auth::user()->BranchDetailsUser->its_branch_id,
                    'tl_detail_route' => 'branch.customer.customer-order-details',
                    'tl_all_route' => 'branch.OrderReport.total-order',
                ])
            </div>

            {{-- People + quick actions --}}
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-xl-12 col-md-4">
                        <a href="{{ route('branch.customer.all-customer') }}" class="tl-stat tl-accent-green">
                            <span class="tl-stat-icon"><i class="fas fa-user-tie"></i></span>
                            <span>
                                <span class="tl-stat-label d-block">Customers</span>
                                <span class="tl-stat-value d-block">{{ number_format($total_customers) }}</span>
                            </span>
                        </a>
                    </div>
                    <div class="col-xl-6 col-md-4 col-6">
                        <a href="{{ route('branch.supplier.view') }}" class="tl-stat tl-stat-compact tl-accent-brick">
                            <span class="tl-stat-icon"><i class="fas fa-truck"></i></span>
                            <span>
                                <span class="tl-stat-label d-block">Suppliers</span>
                                <span class="tl-stat-value d-block">{{ number_format($total_suppliers) }}</span>
                            </span>
                        </a>
                    </div>
                    <div class="col-xl-6 col-md-4 col-6">
                        <a href="{{ route('branch.user.user-list') }}" class="tl-stat tl-stat-compact tl-accent-navy">
                            <span class="tl-stat-icon"><i class="fas fa-users-cog"></i></span>
                            <span>
                                <span class="tl-stat-label d-block">Staff</span>
                                <span class="tl-stat-value d-block">{{ number_format($total_user) }}</span>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Quick Actions</h3>
                    </div>
                    <div class="card-body">
                        @php
                            $items = [
                                ['route' => 'branch.customer.customer-registration', 'icon' => 'fas fa-user-plus', 'text' => 'Customer Registration', 'accent' => 'tl-accent-gold'],
                                ['route' => 'branch.customer.payments', 'icon' => 'fas fa-hand-holding-usd', 'text' => 'Customer Payment', 'accent' => 'tl-accent-green'],
                                ['route' => 'branch.supplier.payment', 'icon' => 'fas fa-money-bill-wave', 'text' => 'Supplier Payment', 'accent' => 'tl-accent-brick'],
                                ['route' => 'branch.user.user-registration', 'icon' => 'fas fa-user-cog', 'text' => 'User Registration', 'accent' => 'tl-accent-navy'],
                                ['route' => 'branch.price-update.price-update', 'icon' => 'fas fa-tags', 'text' => 'Price Update', 'accent' => 'tl-accent-teal'],
                                ['route' => 'branch.cost.set-making-cost', 'icon' => 'fas fa-coins', 'text' => 'Set Making Cost', 'accent' => 'tl-accent-amber'],
                                ['route' => 'branch.customer.all-customer', 'icon' => 'fas fa-address-book', 'text' => 'View All Customers', 'accent' => 'tl-accent-green'],
                                ['route' => 'branch.user.user-list', 'icon' => 'fas fa-users', 'text' => 'View All Users', 'accent' => 'tl-accent-navy'],
                            ];
                        @endphp
                        <div class="tl-actions">
                            @foreach($items as $item)
                                <a href="{{ route($item['route']) }}" class="tl-action {{ $item['accent'] }}">
                                    <i class="{{ $item['icon'] }}"></i>
                                    <span>{{ $item['text'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/. container-fluid -->
</section>
@endsection
