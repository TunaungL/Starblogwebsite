<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title') — StarBlog Admin</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f8f9fa;
    }

    /* Sidebar */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 240px;
        height: 100vh;
        background-color: #212529;
        color: #fff;
        display: flex;
        flex-direction: column;
        padding-top: 60px;
        overflow-y: auto;
    }
    .sidebar a {
        color: #adb5bd;
        text-decoration: none;
        padding: 12px 20px;
        display: block;
    }
    .sidebar a.active, .sidebar a:hover {
        color: #fff;
        background-color: #343a40;
    }
    .sidebar .logo {
        text-align: center;
        padding: 15px 0;
        border-bottom: 1px solid #343a40;
    }
    .sidebar .logo div {
        font-size: 28px;
        font-weight: bold;
        letter-spacing: 2px;
    }
    .sidebar .logo small {
        font-size: 12px;
        color: #adb5bd;
    }
        .sidebar-link {
        color: #adb5bd;
        text-decoration: none;
        font-size: 1rem;
        display: block;
        padding: 12px 20px;
        text-align: start;
        background: transparent;
        border: none;
    }

    .sidebar-link:hover {
        color: #fff;
        background-color: #343a40;
        cursor: pointer;
    }


    /* Navbar */
    .navbar-custom {
        position: fixed;
        top: 0;
        left: 240px;
        right: 0;
        height: 60px;
        background-color: #fff;
        border-bottom: 1px solid #dee2e6;
        z-index: 1020;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
    }

    /* Content */
    .content {
        margin-left: 240px;
        padding: 80px 20px 20px; /* top padding includes navbar height */
    }
</style>
</head>
<body>


<!-- Sidebar -->
<div class="sidebar d-flex flex-column">
    <div class="logo">
        <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none d-flex flex-column align-items-center">
            <div>STAR<span style="color:#0d6efd;">BLOG</span></div>
            <small>Admin Panel</small>
        </a>
    </div>

    <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
    <a href="{{ route('admin.posts.index') }}"><i class="bi bi-file-earmark-text me-2"></i> Posts</a>
    <a href="{{ route('admin.posts.create') }}"><i class="bi bi-plus-square me-2"></i> Create Posts</a>
    <a href="{{ route('admin.categories.index') }}"><i class="bi bi-tags me-2"></i> Categories</a>
    <a href="{{ route('admin.categories.create') }}"><i class="bi bi-plus-square me-2"></i> Add Category</a>
    <a href="{{ route('admin.users.index') }}"><i class="bi bi-people me-2"></i> Users</a>
    <a href="{{ route('admin.users.create') }}"><i class="bi bi-person-plus me-2"></i> Add User</a>

    <!-- Push logout to bottom -->
    <div class="mt-auto">
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="w-100 text-start border-0 bg-transparent sidebar-link">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
        </form>
    </div>
</div>



<!-- Top Navbar -->
<nav class="navbar-custom d-flex justify-content-between align-items-center px-3">
    <h5 class="mb-0">@yield('title')</h5>

    <div class="d-flex align-items-center gap-3">
        @php $user = auth()->user(); @endphp

        <!-- Admin Logo Button (only for admin) -->
        @if($user->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger fw-bold" title="Admin Dashboard">
                Admin Dashboard
            </a>
        @endif

        <!-- User Logo Button -->
        <a href="{{ route('blog.index') }}" class="btn btn-outline-primary fw-bold" title="User Dashboard">
            User Dashboard
        </a>

        <!-- Profile Icon -->
        <a href="{{ route('profile.index') }}" class="text-dark fs-5">
            <i class="bi bi-person-circle">Profile</i>
        </a>

        <!-- User Name -->
        <span>{{ $user->name }}</span>
    </div>
</nav>

<!-- Main Content -->
<div class="content">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
