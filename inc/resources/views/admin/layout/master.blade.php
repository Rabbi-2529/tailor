<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{ env("APP_NAME") }}</title>

  {{-- restore the collapsed sidebar before first paint --}}
  <script>try { if (localStorage.getItem('tl-sidebar-collapsed') === '1') document.documentElement.classList.add('tl-collapsed'); } catch (e) {}</script>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datepicker/daterangepicker.css')}}">

  @yield('custom_style')

  <link rel="stylesheet" href="{{ asset('assets/dist/css/custom.css') }}">
  <!-- Fonts + tailoring theme -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/dist/css/tailor-theme.css') }}?v=2.2">
</head>
<body>
<div class="tl-app">
  @include('admin.layout.sidebar')

  <div class="tl-main">
    @include('admin.layout.header')

    <main class="tl-content">
      @yield('content')
    </main>

    @include('admin.layout.footer')
  </div>
</div>
<div class="tl-backdrop" data-tl-sidebar-close></div>

@include('layouts.scripts')
@yield('custom_script')
</body>
</html>
