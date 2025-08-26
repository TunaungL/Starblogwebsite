<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - STARBLOG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .register-card {
            position: relative;
            max-width: 450px;
            margin: 6rem auto;
            padding: 2.5rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 1.5rem;
            color: #000;
            border: none;
            background: transparent;
        }
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
        .input-group {
            position: relative;
        }
    </style>
</head>
<body>

<div class="register-card">
    <!-- Close Button -->
    <a href="/" class="close-btn"><i class="bi bi-x-lg"></i></a>

    <h2 class="text-center mb-4">Register to STARBLOG</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Your name" value="{{ old('name') }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="name@example.com" value="{{ old('email') }}" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Password -->
        <div class="mb-3 position-relative">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            <i class="bi bi-eye-slash password-toggle" onclick="togglePassword('password', this)"></i>
        </div>
        @error('password') <small class="text-danger">{{ $message }}</small> @enderror

        <!-- Confirm Password -->
        <div class="mb-3 input-group">
            <input type="password" id="confirm_password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
            <i class="bi bi-eye-slash password-toggle" onclick="togglePassword('confirm_password', this)"></i>
        </div>
        @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror

        <button type="submit" class="btn btn-dark w-100 rounded-pill mb-3">Register</button>
    </form>

    <p class="text-center mb-3">Or register with</p>

    <!-- Google Register 
    <a href="{{ route('googleregister') }}" class="btn btn-outline-danger w-100 rounded-pill social-btn">
        <i class="bi bi-google"></i> Google
    </a>
      -->
    <p class="text-center mt-3">
        Already have an account? <a href="{{ route('login') }}">Login</a>
    </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword(fieldId, icon) {
        const field = document.getElementById(fieldId);
        if (field.type === "password") {
            field.type = "text";
            icon.classList.replace("bi-eye-slash", "bi-eye");
        } else {
            field.type = "password";
            icon.classList.replace("bi-eye", "bi-eye-slash");
        }
    }
</script>
</body>
</html>
