@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    <!-- Top Summary Cards -->
    <div class="row g-4 mb-4">
        @php
            $cardData = [
                ['title' => 'Total Posts', 'count' => \App\Models\Post::count(), 'icon' => 'bi-file-earmark-text', 'color' => 'primary'],
                ['title' => 'Total Categories', 'count' => \App\Models\Category::count(), 'icon' => 'bi-tags', 'color' => 'success'],
                ['title' => 'Total Users', 'count' => \App\Models\User::count(), 'icon' => 'bi-people', 'color' => 'warning'],
                ['title' => 'Active Users', 'count' => \App\Models\User::where('is_active',1)->count(), 'icon' => 'bi-person-check', 'color' => 'info'],
            ];
        @endphp

        @foreach($cardData as $card)
        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-white bg-{{ $card['color'] }}">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">{{ $card['title'] }}</h6>
                        <h3 class="mb-0">{{ $card['count'] }}</h3>
                    </div>
                    <i class="bi {{ $card['icon'] }} fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Latest Posts Table -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 p-3">
                <h5 class="mb-3">Latest Posts</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Created At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Post::latest()->take(5)->get() as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category->name ?? '-' }}</td>
                                <td>{{ $post->user->name ?? '-' }}</td>
                                <td>{{ $post->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('blog.edit', $post) }}" class="btn btn-sm btn-outline-warning me-1">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('blog.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary mt-3">View All Posts</a>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="row g-4">
        <div class="col-md-4">
            <a href="{{ route('admin.categories.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 p-3 text-center h-100 hover-scale">
                    <i class="bi bi-tags fs-2 mb-2 text-primary"></i>
                    <h6 class="mb-0">Manage Categories</h6>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 p-3 text-center h-100 hover-scale">
                    <i class="bi bi-people fs-2 mb-2 text-success"></i>
                    <h6 class="mb-0">Manage Users</h6>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.posts.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 p-3 text-center h-100 hover-scale">
                    <i class="bi bi-file-earmark-plus fs-2 mb-2 text-warning"></i>
                    <h6 class="mb-0">Add New Post</h6>
                </div>
            </a>
        </div>
    </div>

</div>

<style>
    .hover-scale:hover {
        transform: scale(1.03);
        transition: 0.3s ease-in-out;
    }
</style>
@endsection
