@extends('layouts.app')

@section('title', $post->title . ' — STARBLOG')

@section('content')
<div class="container py-5 mx-auto" style="max-width: 850px; padding: 0 15px;">

    <h1 class="fw-bold display-5 mb-3 text-dark text-break">
        {{ $post->title }}
    </h1>

    @if($post->subtitle)
        <h4 class="fw-light text-muted fs-5 mb-4 text-break">
            {{ $post->subtitle }}
        </h4>
    @endif

    <!-- Author + Category + Date -->
   <div class="d-flex flex-column flex-sm-row flex-wrap align-items-start align-items-sm-center mb-4 text-muted" style="font-size: 0.9rem;">

        <!-- Author -->
        <div class="d-flex align-items-center me-3 mb-2">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name ?? 'Guest') }}&background=0D8ABC&color=fff&size=40" 
                 class="rounded-circle me-2" 
                 width="40" height="40" 
                 alt="{{ $post->user->name ?? 'Guest' }}">
            <span class="fw-semibold text-dark">{{ $post->user->name ?? 'Guest Author' }}</span>
        </div>

        <!-- Category -->
        @if($post->category)
            <span class="badge bg-dark text-white me-2 px-3 py-2 mb-2" style="border-radius: 20px;">
                {{ $post->category->name }}
            </span>
        @endif

        <!-- Date -->
        @if ($post->created_at)
            <span class="mb-2">
                {{ $post->created_at->format('F d, Y') }}
            </span>
        @endif
    </div>

    <!-- Post Image -->
    @if($post->postphoto)
        <div class="text-center mb-4">
        <img src="{{ asset('storage/' . $post->postphoto) }}" 
            class="img-fluid rounded shadow-sm" 
            alt="{{ $post->title }}"
            style="max-height: 450px; object-fit: cover; width: 100%;">
</div>

    @endif

    <!-- Post Content -->
    <article class="fs-5 text-dark mb-5" style="line-height: 1.8; font-family: 'Georgia', serif; word-wrap: break-word;">
    {!! nl2br(e($post->content)) !!}
    </article>

 <!-- #region -->
 <!-- Related Posts -->
@if($relatedposts->count())
    <div class="mt-5">
        <h4 class="fw-bold mb-3">Related Posts</h4>
        <div class="row g-3">
            @foreach($relatedposts as $related)
             <div class="col-12 col-sm-6 col-md-4">
    <div class="card h-100 shadow-sm border-0">
        @if($related->postphoto)
            <img src="{{ asset('storage/' . $related->postphoto) }}" class="card-img-top rounded-top" alt="{{ $related->title }}">
        @endif
        <div class="card-body">
            <h5 class="card-title text-dark text-truncate">
                <a href="{{ route('blog.show', $related->id) }}" class="text-decoration-none text-dark">
                    {{ Str::limit($related->title, 50) }}
                </a>
            </h5>
            <p class="text-muted small mb-2">
                {{ $related->created_at->format('d M Y') }} · {{ $related->category?->name }}
            </p>
            <p class="card-text text-muted">
                {{ Str::limit(strip_tags($related->content), 100) }}
            </p>
        </div>
    </div>
</div>

            @endforeach
        </div>
    </div>
@endif

<!-- More from this Author -->
@if($authorposts->count())
    <div class="mt-5">
        <h4 class="fw-bold mb-3">More from {{ $post->user->name }}</h4>
        <div class="row g-3">
            @foreach($authorposts as $authorPost)
                <div class="col-md-4 col-sm-6">
                    <div class="card h-100 shadow-sm border-0">
                        @if($authorPost->postphoto)
                            <img src="{{ asset('storage/' . $authorPost->postphoto) }}" 
                                 class="card-img-top rounded-top" 
                                 alt="{{ $authorPost->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('blog.show', $authorPost->id) }}" class="text-decoration-none text-dark">
                                    {{ Str::limit($authorPost->title, 50) }}
                                </a>
                            </h5>
                            <p class="text-muted small mb-2">
                                {{ $authorPost->created_at->format('d M Y') }} · 
                                {{ $authorPost->category?->name }}
                            </p>
                            <p class="card-text text-muted">
                                {{ Str::limit(strip_tags($authorPost->content), 100) }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

    <!-- Back Button -->
<div class="mt-5 text-center">
    <a href="{{ route('blog.index') }}" 
       class="btn btn-outline-dark rounded-pill px-4 py-2 w-100 w-md-auto">
        ← Back to Blogs
    </a>
</div>

</div>
@endsection
