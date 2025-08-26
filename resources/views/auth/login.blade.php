<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - STARBLOG</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .login-card {
      position: relative; /* Needed for absolute close button */
      border-radius: 1.5rem;
      max-width: 450px;
      margin: 5rem auto;
      padding: 3rem;
      background: #fff;
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .close-btn {
      position: absolute;
      top: 15px;
      right: 20px;
      font-size: 1.5rem;
      text-decoration: none;
      color: #000;
      font-weight: bold;
    }

    .logo {
      font-weight: 700;
      font-size: 2.5rem;
      color: #212529;
      letter-spacing: 2px;
    }

    .btn-outline-social {
      border-width: 2px;
      padding: 0.7rem 1.2rem;
      font-size: 1.1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    .form-control {
      height: 50px;
    }
  </style>
</head>
<body>

<div class="login-card text-center">
  <!-- Close Button -->
  <a href="/" class="close-btn">&times;</a>

  <div class="mb-4">
    <span class="logo">STARBLOG</span>
    <h4 class="mt-2">Welcome Back</h4>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <!-- Google Login 
  <a href="{{ url('auth/google') }}" class="btn btn-outline-danger w-100 mb-4 btn-outline-social">
    <svg width="20" height="20" viewBox="0 0 533.5 544.3">
      <path fill="#4285F4" d="M533.5 278.4c0-17.4-1.4-34.2-4.1-50.5H272v95.5h146.9c-6.4 34.6-25.7 63.9-54.7 83.4v69.3h88.5c51.8-47.7 81.8-118 81.8-197.7z"/>
      <path fill="#34A853" d="M272 544.3c73.8 0 135.7-24.4 180.9-66.3l-88.5-69.3c-24.6 16.5-56.2 26-92.4 26-71 0-131-47.9-152.5-112.1H30.6v70.4C76.1 482 168.8 544.3 272 544.3z"/>
      <path fill="#FBBC05" d="M119.5 324.9c-5.8-17.4-9.1-36-9.1-55s3.3-37.6 9.1-55v-70.4H30.6C11.2 200.6 0 238.6 0 278.9s11.2 78.3 30.6 106.3l88.9-70.3z"/>
      <path fill="#EA4335" d="M272 107.9c38.5 0 73 13.3 100.3 39.4l75.3-75.3C407.7 24.4 345.8 0 272 0 168.8 0 76.1 62.3 30.6 155.9l88.9 70.4c21.5-64.2 81.5-112.1 152.5-112.1z"/>
    </svg>
    Login with Google
  </a>
-->
  <!-- Email Login Form -->
  <form action="{{ route('login.submit') }}" method="POST" class="mb-3">
    @csrf
    <div class="mb-3">
      <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
      @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <input type="password" name="password" class="form-control" placeholder="Password">
      @error('password') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3 form-check text-start">
      <input type="checkbox" name="remember" class="form-check-input" id="remember">
      <label class="form-check-label" for="remember">Remember Me</label>
    </div>

    <button type="submit" class="btn btn-dark w-100 rounded-pill mb-3">Login</button>
  </form>

  <p class="small text-muted">
    Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Register here</a>
  </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
