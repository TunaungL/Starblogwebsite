<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Blog</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        /* Profile icon hover effect */
        .profile-icon svg {
            transition: transform 0.3s ease, stroke 0.3s ease;
        }
        .profile-icon:hover svg {
            transform: scale(1.2);
            stroke: #8cc5bcff;
        }
    </style>
</head>
<body>
  
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-2">
  <div class="container-fluid d-flex justify-content-between align-items-center">

    <!-- Left: Logo + Search -->
    <div class="d-flex align-items-center gap-3">
      <a class="navbar-brand fw-bold fs-4" href="\">StarBlog</a>
      <form class="d-none d-lg-flex position-relative" action="/search" method="GET" style="width: 300px;">
        <span class="position-absolute top-50 start-0 translate-middle-y ps-3 text-muted">
          <i class="fas fa-search"></i>
        </span>
        <input 
          type="search" 
          name="q" 
          class="form-control rounded-pill ps-5" 
          placeholder="Search..."
          style="background-color: #f0f0f0;" 
        >
      </form>
    </div>

    <!-- Middle: Empty -->
    <div></div>

    <!-- Right: Buttons/Icons -->
    <div class="d-flex align-items-center gap-4">

      <a href="{{ route('blog.create') }}" class="btn btn-outline-dark btn-sm d-flex align-items-center">
        <i class="fas fa-feather me-1"></i> Write
      </a>

      <a href="#" class="text-dark fs-5"><i class="fas fa-bell"></i></a>

@auth
@php
    $user = auth()->user();
    $isAdmin = strtolower($user->role) === 'admin';
    $dashboardRoute = $isAdmin ? route('admin.dashboard') : route('profile.index');
@endphp

<!-- Profile Link: icon + name + role -->
<a href="{{ $dashboardRoute }}" 
   class="text-dark fs-5 d-inline-flex align-items-center text-decoration-none gap-2">
    <!-- Profile SVG -->
    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 24 24">
        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-3.33 0-10 1.67-10 5v3h20v-3c0-3.33-6.67-5-10-5z"/>
    </svg>
    <div class="d-flex flex-column" style="line-height:1;">
        <span class="fw-bold">{{ $user->name }}</span>
        <small class="text-muted" style="font-size:0.75rem;">{{ ucfirst($user->role) }}</small>
    </div>
</a>

<!-- Logout Button -->
<form action="{{ route('logout') }}" method="POST" class="d-inline ms-2">
    @csrf
    <button type="submit" class="btn btn-sm btn-outline-danger">
        <i class="fas fa-sign-out-alt"></i> Logout
    </button>
</form>
@endauth




    </div>
  </div>
</nav>

<div class="container">
    @yield('content')
</div>

</body>
</html>
