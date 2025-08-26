@extends('layouts.app')

<!-- Section title -->
   

@section('content')


<main class="py-4">
    <div class="container py-4">
  <!-- Section title -->
  <h5 class="mb-3">Trending Topics</h5>

  <!-- Bootstrap Carousel wrapper -->
  <div id="topicsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="15000">
    
    <!-- Carousel inner container -->
    <div class="carousel-inner">

      <!-- First slide -->
      <div class="carousel-item active">
        <!-- Flex container to arrange badges horizontally -->
        <div class="d-flex justify-content-between flex-wrap gap-2">
          <!-- Each topic is a Bootstrap badge styled as a pill -->
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

    <!-- Carousel controls (previous / next arrows) -->
    <button class="carousel-control-prev" type="button" data-bs-target="#topicsCarousel" data-bs-slide="prev"
      style="width:40px; opacity:0.5;">
      <!-- The actual arrow icon -->
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#topicsCarousel" data-bs-slide="next"
      style="width:40px; opacity:0.5;">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>

<!-- Bootstrap JS bundle for Carousel functionality -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!--
Customization / Notes:
1. 'd-flex justify-content-between flex-wrap gap-2' makes badges spread evenly across the slide.
2. 'flex-fill' ensures badges grow equally to fill available space.
3. 'p-2' gives padding inside each badge, 'text-center' centers the text.
4. Different background colors (bg-primary, bg-secondary, bg-success) visually separate slides.
5. Carousel controls are made subtle with 'opacity:0.5' and smaller width.
6. Using multiple slides allows showing all topics in sets of 6 (or fewer for the last slide).
7. No extra spacing issues because 'flex-wrap' + 'gap-2' handles responsiveness.
-->

    <div class="container">
           <div class="row g-4">
            {{-- Posts List --}}
            <div class="col-lg-8">
                @foreach($posts as $post)
                    <article class="post-card p-3 p-md-4 mb-3 rounded-4 border">
                        <div class="row g-3 align-items-stretch">
                            <div class="col-md-8 d-flex flex-column">

                                {{-- Author Info --}}
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

                                {{-- Post Title & Excerpt --}}
                                <h2 class="h4 post-title mb-2">
                                    <a href="{{ route('blog.show',$post->id) }}" class="text-decoration-none text-dark">
                                        {{ $post->title }}
                                    </a>
                                </h2>
                                <p class="post-excerpt">{{ Str::limit($post->content, 150) }}</p>

                                {{-- Post Tags --}}
                                <div class="d-flex flex-wrap gap-2 mt-2">
                                    @if($post->category)
                                        <span class="badge bg-secondary">{{ $post->category->name }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Post Thumbnail --}}
                            <div class="col-md-4">
                                @if($post->postphoto)
                                    <img src="{{ asset('storage/'.$post->postphoto) }}" class="thumbnail w-100 rounded" alt="{{ $post->title }}">
                                @else
                                    <img src="https://via.placeholder.com/300x160" class="thumbnail w-100 rounded" alt="No Image">
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            </div>

            {{-- Sidebar --}}
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

<style>
.avatar {
    width:36px; height:36px; border-radius:50%;
    background:#eee; display:flex; align-items:center; justify-content:center;
    font-weight:bold; color:#555;
}
.post-card { transition: box-shadow .2s ease; }
.post-card:hover { box-shadow:0 12px 28px rgba(0,0,0,.08); }
.thumbnail { height:160px; object-fit:cover; }
</style>

@endsection
