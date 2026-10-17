@extends('user.layout.master')
@section('dashboard','menu-open')
@section('dashboard_link','active')
@section('content')
@php
    $tl_hour = (int) now()->format('G');
    $tl_greeting = $tl_hour < 12 ? 'Good morning' : ($tl_hour < 17 ? 'Good afternoon' : 'Good evening');
@endphp
<section class="content">
    <div class="container-fluid">
        @if (session()->has('user'))
        <div class="alert alert-success alert-dismissible mt-3 mb-0" role="alert">
           {{ session()->get('user') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        {{-- Welcome --}}
        <div class="tl-hero">
            <i class="fas fa-cut tl-hero-icon"></i>
            <div>
                <div class="tl-hero-eyebrow">Staff Dashboard</div>
                <h1>{{ $tl_greeting }}, {{ Auth::user()->its_username }}</h1>
                <p>{{ number_format($today_order) }} new {{ \Illuminate\Support\Str::plural('order', $today_order) }} today</p>
            </div>
            <div class="tl-hero-actions">
                <a href="{{ route('user.customer.customer-registration') }}" class="btn btn-ghost"><i class="fas fa-user-plus mr-1"></i> Customer Registration</a>
                <a href="{{ route('user.customer.payments') }}" class="btn btn-gold"><i class="fas fa-hand-holding-usd mr-1"></i> Customer Payment</a>
            </div>
        </div>

        {{-- Stats --}}
        <div class="row">
            <div class="col-xl-3 col-sm-6 col-6">
                <a href="{{ route('user.OrderReport.today-order') }}" class="tl-stat tl-accent-gold">
                    <span class="tl-stat-icon"><i class="fas fa-calendar-day"></i></span>
                    <span>
                        <span class="tl-stat-label d-block">Today's Orders</span>
                        <span class="tl-stat-value d-block">{{ number_format($today_order) }}</span>
                    </span>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 col-6">
                <a href="{{ route('user.OrderReport.total-order') }}" class="tl-stat tl-accent-navy">
                    <span class="tl-stat-icon"><i class="fas fa-clipboard-list"></i></span>
                    <span>
                        <span class="tl-stat-label d-block">Total Orders</span>
                        <span class="tl-stat-value d-block">{{ number_format($total_order) }}</span>
                    </span>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 col-6">
                <a href="{{ route('user.customer.all-customer') }}" class="tl-stat tl-accent-green">
                    <span class="tl-stat-icon"><i class="fas fa-user-tie"></i></span>
                    <span>
                        <span class="tl-stat-label d-block">Customers</span>
                        <span class="tl-stat-value d-block">{{ number_format($total_customers) }}</span>
                    </span>
                </a>
            </div>
            <div class="col-xl-3 col-sm-6 col-6">
                <a href="{{ route('branch.supplier.view') }}" class="tl-stat tl-accent-brick">
                    <span class="tl-stat-icon"><i class="fas fa-truck"></i></span>
                    <span>
                        <span class="tl-stat-label d-block">Suppliers</span>
                        <span class="tl-stat-value d-block">{{ number_format($total_suppliers) }}</span>
                    </span>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8">
                @include('layouts.tailor_recent_orders', [
                    'tl_com' => Auth::user()->UserDetails->its_user_com_id,
                    'tl_bran' => Auth::user()->UserDetails->its_user_bran_id,
                    'tl_detail_route' => 'user.customer.customer-order-details',
                    'tl_all_route' => 'user.OrderReport.total-order',
                ])
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Quick Actions</h3>
                    </div>
                    <div class="card-body">
                        <div class="tl-actions">
                            <a href="{{ route('user.customer.customer-registration') }}" class="tl-action tl-accent-gold"><i class="fas fa-user-plus"></i><span>Customer Registration</span></a>
                            <a href="{{ route('user.customer.all-customer') }}" class="tl-action tl-accent-green"><i class="fas fa-address-book"></i><span>View All Customers</span></a>
                            <a href="{{ route('user.customer.payments') }}" class="tl-action tl-accent-teal"><i class="fas fa-hand-holding-usd"></i><span>Customer Payment</span></a>
                            <a href="{{ route('user.supplier.payment') }}" class="tl-action tl-accent-brick"><i class="fas fa-money-bill-wave"></i><span>Supplier Payment</span></a>
                        </div>
                        <div class="text-muted small mt-3">
                            <i class="fas fa-users mr-1 text-gold"></i> {{ number_format($total_user) }} staff in this branch
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/. container-fluid -->
</section>
@endsection
