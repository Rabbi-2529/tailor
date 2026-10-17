@extends('admin.layout.master')
@section('dashboard','menu-open')
@section('dashboard_link','active')
@section('content')
<section class="content">
  <div class="container-fluid">
    @if (session()->has('admin'))
    <div class="alert alert-success alert-dismissible mt-3 mb-0" role="alert">
       {{ session()->get('admin') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="tl-hero">
      <i class="fas fa-cut tl-hero-icon"></i>
      <div>
        <div class="tl-hero-eyebrow">Admin Dashboard</div>
        <h1>Welcome back, {{ Auth::user()->its_username }}</h1>
        <p>Manage the tailoring houses and branches on IGL Tailor Solution.</p>
      </div>
      <div class="tl-hero-actions">
        <a href="{{ route('admin.branch-registration') }}" class="btn btn-ghost"><i class="fas fa-store mr-1"></i> New Branch</a>
        <a href="{{ route('admin.company-registration') }}" class="btn btn-gold"><i class="fas fa-building mr-1"></i> New Company</a>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-3 col-sm-6 col-6">
        <a href="{{ route('admin.company-list') }}" class="tl-stat tl-accent-gold">
          <span class="tl-stat-icon"><i class="fas fa-building"></i></span>
          <span>
            <span class="tl-stat-label d-block">Companies</span>
            <span class="tl-stat-value d-block">{{ number_format($company_count) }}</span>
          </span>
        </a>
      </div>
      <div class="col-xl-3 col-sm-6 col-6">
        <a href="{{ route('admin.branch-list') }}" class="tl-stat tl-accent-navy">
          <span class="tl-stat-icon"><i class="fas fa-store-alt"></i></span>
          <span>
            <span class="tl-stat-label d-block">Branches</span>
            <span class="tl-stat-value d-block">{{ number_format($branch_count) }}</span>
          </span>
        </a>
      </div>
    </div>

    <div class="tl-section-title">Quick Actions</div>
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-3">
        <a href="{{ route('admin.company-registration') }}" class="tl-action tl-accent-gold"><i class="fas fa-building"></i><span>Company Registration</span></a>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <a href="{{ route('admin.company-list') }}" class="tl-action tl-accent-brick"><i class="fas fa-list-ul"></i><span>View Company</span></a>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <a href="{{ route('admin.branch-registration') }}" class="tl-action tl-accent-green"><i class="fas fa-store"></i><span>Branch Registration</span></a>
      </div>
      <div class="col-xl-3 col-sm-6 mb-3">
        <a href="{{ route('admin.branch-list') }}" class="tl-action tl-accent-navy"><i class="fas fa-store-alt"></i><span>View All Branches</span></a>
      </div>
    </div>
  </div><!--/. container-fluid -->
</section>
@endsection
