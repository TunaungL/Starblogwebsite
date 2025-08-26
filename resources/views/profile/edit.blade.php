@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>{{ $user->name }}'s Profile</h2>
    <p>Email: {{ $user->email }}</p>
</div>

<div class="container py-5">
    <h3 class="mt-4">Your Posts</h3>

    @if ($posts->isEmpty())
        <p>You haven't created any post yet.</p>
    @else
        <div class="row g-4">
            @foreach($posts as $post)
                <div class="col-md-12">
                    <div class="card mb-3 shadow-sm">
                        <div class="row g-0">
                            <!-- Left: Post Image -->
                            <div class="col-md-4 d-flex align-items-center justify-content-center p-2">
                                @if($post->postphoto)
                                    <img 
                                        src="{{ asset('storage/' . $post->postphoto) }}" 
                                        class="img-fluid rounded-start" 
                                        alt="Post Image" 
                                        style="max-height: 180px; object-fit: cover; width: 100%;">
                                @else
                                    <img 
                                        src="https://via.placeholder.com/300x200" 
                                        class="img-fluid rounded-start" 
                                        alt="No Image"
                                        style="max-height: 180px; object-fit: cover; width: 100%;">
                                @endif
                            </div>

                            <!-- Right: Title + Content + Buttons -->
                            <div class="col-md-8">
                                <div class="card-body d-flex flex-column justify-content-between h-100">
                                    <div>
                                         <!-- Eye-catching Title -->
                                        <h4 class="card-title fw-bold mb-2" style="font-size: 1.5rem;">
                                            <a href="{{ route('blog.show', $post->id) }}" class="text-dark text-decoration-none">
                                                {{ $post->title }}
                                            </a>

                                         @if($post->category)
                                                <span class="badge bg-secondary ms-2">{{ $post->category->name }}</span>
                                            @endif
                                        </h4>

                                        <!-- Secondary Title / Subtitle -->
                                        <h6 class="mb-2 fw-light text-muted" style="font-size: 0.9rem;">
                                            {{ $post->subtitle  }}
                                        </h6>
                                        <p class="card-text">{{ Str::limit($post->content, 150) }}</p>
                                    </div>

                                    <!-- Edit/Delete Buttons -->
                                    <div class="d-flex gap-2 mt-2">
                                        <a href="{{ route('blog.edit', $post->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('blog.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                     <p class="text-muted mb-2">Created at: {{ $post->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
