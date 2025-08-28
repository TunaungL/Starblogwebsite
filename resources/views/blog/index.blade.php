@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container py-4">

        <!-- Section title -->
        <h5 class="mb-3">Trending Topics</h5>

        <!-- Bootstrap Carousel wrapper -->
        <div id="topicsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="15000">
            <div class="carousel-inner">

                <!-- First slide -->
                <div class="carousel-item active">
                    <div class="d-flex justify-content-between flex-wrap gap-2">
                        <span class="badge bg-primary p-2 flex-fill text-center">Artificial Intelligence</span>
                        <span class="badge bg-primary p-2 flex-fill text-center">Coding</span>
                        <span class="badge bg-primary p-2 flex-fill text-center">Sexuality</span>
                        <span class="badge bg-primary p-2 flex-fill text-center">Self Improvement</span>
                        <span class="badge bg-primary p-2 flex-fill text-center">Business</span>
                        <span class="badge bg-primary p-2 flex-fill text-center">Blockchain</span>
                    </div>
                </div>

                <!-- Second slide -->
                <div class="carousel-item">
                    <div class="d-flex justify-content-between flex-wrap gap-2">
                        <span class="badge bg-secondary p-2 flex-fill text-center">Web Development</span>
                        <span class="badge bg-secondary p-2 flex-fill text-center">Marketing</span>
                        <span class="badge bg-secondary p-2 flex-fill text-center">Deep Learning</span>
                        <span class="badge bg-secondary p-2 flex-fill text-center">Psychology</span>
                        <span class="badge bg-secondary p-2 flex-fill text-center">Money</span>
                        <span class="badge bg-secondary p-2 flex-fill text-center">Mental Health</span>
                    </div>
                </div>

                <!-- Third slide -->
                <div class="carousel-item">
                    <div class="d-flex justify-content-between flex-wrap gap-2">
                        <span class="badge bg-success p-2 flex-fill text-center">Design</span>
                        <span class="badge bg-success p-2 flex-fill text-center">Technology</span>
                        <span class="badge bg-success p-2 flex-fill text-center">Data Science</span>
                        <span class="badge bg-success p-2 flex-fill text-center">Programming</span>
                    </div>
                </div>
            </div>

            <!-- Carousel controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#topicsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon custom-arrow" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#topicsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon custom-arrow" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Posts Section -->
    <div class="container mt-4">
        <div class="row g-4">
            
            <!-- Posts List -->
            <div class="col-lg-8">
                @foreach($posts as $post)
                    <article class="post-card p-3 p-md-4 mb-3 rounded-4 border">
                        <div class="row g-3 align-items-stretch">
                            
                            <!-- Post Content -->
                            <div class="col-md-8 d-flex flex-column">
                                <a href="{{ route('blog.show',$post->id) }}" class="text-decoration-none text-dark">
                                    
                                    <!-- Author Info -->
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        @if($post->user && $post->user->avatar)
                                            <img class="avatar" src="{{ asset('storage/'.$post->user->avatar) }}" alt="{{ $post->user->name }}">
                                        @else
                                            <div class="avatar">{{ strtoupper(substr($post->user->name ?? 'G',0,1)) }}</div>
                                        @endif
                                        <div class="small text-muted">
                                            <strong>{{ $post->user->name ?? 'Guest' }}</strong>
                                            · {{ $post->created_at->format('M j, Y') }}
                                            · {{ ceil(str_word_count($post->content)/200) }} min read
                                        </div>
                                    </div>

                                    <!-- Title + Excerpt -->
                                    <h2 class="h4 post-title mb-2">{{ $post->title }}</h2>
                                    <p class="post-excerpt">{{ Str::limit($post->content, 150) }}</p>

                                    <!-- Tags -->
                                    <div class="d-flex flex-wrap gap-2 mt-2">
                                        @if($post->category)
                                            <span class="badge bg-secondary">{{ $post->category->name }}</span>
                                        @endif
                                    </div>
                                </a>
                            </div>

                            <!-- Thumbnail -->
                            <div class="col-md-4">
                                @if($post->postphoto)
                                    <img src="{{ asset('storage/'.$post->postphoto) }}" class="thumbnail w-100 rounded" alt="{{ $post->title }}">
                                @else
                                    <img src="https://via.placeholder.com/300x160" class="thumbnail w-100 rounded" alt="No Image">
                                @endif
                            </div>
                        </div>

                        <!-- Likes + Comments -->
                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <!-- Like Button -->
                            <form action="{{ route('posts.like', $post->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-outline-primary">
                                    👍 {{ $post->likes->count() }}
                                </button>
                            </form>

                            <!-- Comment Toggle -->
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#comments-{{ $post->id }}">
                                💬 {{ $post->comments_count }} comments
                            </button>
                        </div>

                        <!-- Comment Section -->
                        <div class="collapse mt-2" id="comments-{{ $post->id }}">
                            
                            <!-- Comment Form -->
                            <form action="{{ route('posts.comment', $post->id) }}" method="POST">
                                @csrf
                                <div class="mb-2">
                                    <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" rows="2" placeholder="Write a comment...">{{ old('comment') }}</textarea>
                                    @error('comment')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button class="btn btn-sm btn-primary">Comment</button>
                            </form>

                            <!-- Existing Comments -->
                            <div class="mt-2">
                                @foreach($post->comments as $comment)
                                    <div class="border-top pt-2 mt-2">
                                        <strong>{{ $comment->user->name ?? 'Guest' }}</strong>:
                                        {{ $comment->comment }}
                                        <div class="small text-muted">{{ $comment->created_at->diffForHumans() }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </article>
                @endforeach

                <!-- Pagination -->
                <div class="mt-4">
                   {{ $posts->links('pagination::bootstrap-5') }}

                </div>
            </div>

            <!-- Sidebar -->
            <aside class="col-lg-4 sidebar">
                <div class="p-4 rounded-4 border">
                    <h6>Recommended Topics</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($popularTags as $tag)
                            <span class="badge bg-light text-dark">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            </aside>
        </div>
    </div>
</main>

<!-- Styles -->
<style>
    .avatar {
        width:36px; height:36px; border-radius:50%;
        background:#eee; display:flex; align-items:center; justify-content:center;
        font-weight:bold; color:#555;
    }
    .post-card { transition: box-shadow .2s ease; }
    .post-card:hover { box-shadow:0 12px 28px rgba(0,0,0,.08); }
    .thumbnail { height:160px; object-fit:cover; }
   
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-image: none !important; /* remove Bootstrap's default arrow SVG */
    width: auto;
    height: auto;
}

.carousel-control-prev span,
.carousel-control-next span {
    font-size: 2rem;      /* make your arrow text nice size */
    font-weight: bold;
    color: #fff;          /* arrow color */
}


</style>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
