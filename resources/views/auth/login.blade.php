<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - STARBLOG</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .login-card {
      position: relative;
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

    .form-control {
      height: 50px;
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

    .input-group .bi {
      cursor: pointer;
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

  <form action="{{ route('login.submit') }}" method="POST" class="mb-3">
    @csrf
    <!-- Email -->
    <div class="mb-3">
      <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
      @error('email') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <!-- Password with Bootstrap Icon -->
    <div class="mb-3">
      <div class="input-group">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
        <span class="input-group-text" id="togglePassword">
          <i class="bi bi-eye" id="eyeIcon"></i>
        </span>
      </div>
      @error('password') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <!-- Remember Me -->
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
<script>
  const togglePassword = document.getElementById('togglePassword');
  const password = document.getElementById('password');
  const eyeIcon = document.getElementById('eyeIcon');

  togglePassword.addEventListener('click', () => {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    // Toggle eye / eye-slash
    eyeIcon.classList.toggle('bi-eye');
    eyeIcon.classList.toggle('bi-eye-slash');
  });
</script>

</body>
</html>
