<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ env("APP_NAME") }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
  <!-- Fonts + tailoring theme -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/dist/css/tailor-theme.css') }}?v=1.3">
</head>
<body class="hold-transition">
<div class="tl-login">

  {{-- Brand panel --}}
  <div class="tl-login-art">
    <i class="fas fa-cut tl-login-bg-icon"></i>
    <div class="tl-login-brand">
      <span class="tl-brand-mark"><i class="fas fa-cut"></i></span>
      <span>
        <strong>IGL Tailor</strong>
        <small>Bespoke Suite</small>
      </span>
    </div>

    <div class="tl-login-copy">
      <h1>Every stitch, <em>measured</em> and on time.</h1>
      <p>Run your tailoring house from one place: customers and their measurements, orders and makers, fabrics, payments and deliveries.</p>
      <ul class="tl-login-features">
        <li><i class="fas fa-ruler-combined"></i> Measurements</li>
        <li><i class="fas fa-clipboard-list"></i> Order tracking</li>
        <li><i class="fas fa-cut"></i> Makers &amp; payments</li>
        <li><i class="fas fa-tshirt"></i> Fabrics &amp; stock</li>
      </ul>
    </div>

    <div class="tl-login-art-foot">&copy; {{ date('Y') }} <a href="http://iglweb.com" class="text-gold">IGL Web Ltd</a></div>
  </div>

  {{-- Sign in --}}
  <div class="tl-login-panel">
    <div class="tl-login-card">
      <div class="tl-login-mobile-brand tl-login-brand">
        <span class="tl-brand-mark"><i class="fas fa-cut"></i></span>
        <span>
          <strong>IGL Tailor</strong>
          <small>Bespoke Suite</small>
        </span>
      </div>

      <h2>Welcome back</h2>
      <p class="tl-login-sub">Sign in to start your session</p>

      @if (session()->has('err'))
      <div class="alert alert-danger">{{ session()->get('err') }}</div>
      @endif
      @if (session()->has('logout'))
      <div class="alert alert-success">{{ session()->get('logout') }}</div>
      @endif
      {{ Form::open(['action' => 'AuthController@processLogin' , 'method' => 'post']) }}
        <label for="tl-login-email">Email or mobile</label>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <input type="text" id="tl-login-email" name="email" class="form-control" placeholder="you@example.com" required autofocus>
        </div>
        <label for="tl-login-pass">Password</label>
        <div class="input-group mb-4">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <input type="password" id="tl-login-pass" name="pass" class="form-control" placeholder="Your password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-signin">Sign In <i class="fas fa-arrow-right ml-1"></i></button>
      {{ Form::close() }}
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

</body>
</html>
