@extends('company.layout.master')
@section('dashboard','menu-open')
@section('dashboard_link','active')
@section('content')
<section class="content">
  <div class="container-fluid">
    @if (session()->has('company'))
    <div class="alert alert-success alert-dismissible mt-3 mb-0" role="alert">
       {{ session()->get('company') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="tl-hero">
      <i class="fas fa-cut tl-hero-icon"></i>
      <div>
        <div class="tl-hero-eyebrow">Company Dashboard</div>
        <h1>Welcome back, {{ Auth::user()->its_username }}</h1>
        <p>Your tailoring branches at a glance.</p>
      </div>
      <div class="tl-hero-actions">
        <a href="{{ route('company.branch-list') }}" class="btn btn-ghost"><i class="fas fa-store-alt mr-1"></i> All Branches</a>
        <a href="{{ route('company.branch-registration') }}" class="btn btn-gold"><i class="fas fa-store mr-1"></i> New Branch</a>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-3 col-sm-6 col-6">
        <a href="{{ route('company.branch-list') }}" class="tl-stat tl-accent-navy">
          <span class="tl-stat-icon"><i class="fas fa-store-alt"></i></span>
          <span>
            <span class="tl-stat-label d-block">Branches</span>
            <span class="tl-stat-value d-block">{{ number_format($branch) }}</span>
          </span>
        </a>
      </div>
    </div>

    <div class="tl-section-title">Quick Actions</div>
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-3">
        <a href="{{ route('company.branch-registration') }}" class="tl-action tl-accent-gold"><i class="fas fa-store"></i><span>Branch Registration</span></a>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <a href="{{ route('company.branch-list') }}" class="tl-action tl-accent-navy"><i class="fas fa-store-alt"></i><span>View All Branches</span></a>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <a href="{{ route('company.balance') }}" class="tl-action tl-accent-green"><i class="fas fa-wallet"></i><span>Balance</span></a>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <a href="{{ route('company.sms-setup') }}" class="tl-action tl-accent-teal"><i class="fas fa-sms"></i><span>SMS Setup</span></a>
      </div>
    </div>
  </div><!--/. container-fluid -->
</section>
@endsection
