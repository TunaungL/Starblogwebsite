@extends('layouts.app')

@section('title', 'Edit: ' . $post->title . ' — STARBLOG')

@section('content')
<div class="container py-5 mx-auto" style="max-width: 850px; padding: 0 15px;">

    <h1 class="fw-bold display-5 mb-3 text-dark text-break">
        Edit Post
    </h1>

    <form action="{{ route('blog.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label fw-semibold">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                   value="{{ old('title', $post->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Subtitle -->
        <div class="mb-3">
            <label for="subtitle" class="form-label fw-semibold">Subtitle</label>
            <input type="text" name="subtitle" id="subtitle" class="form-control @error('subtitle') is-invalid @enderror" 
                   value="{{ old('subtitle', $post->subtitle) }}">
            @error('subtitle')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label for="category_id" class="form-label fw-semibold">Category</label>
            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                @foreach(\App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Post Image -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Post Image</label>

            <div class="d-flex justify-content-center align-items-center gap-4 mb-2">

                <!-- Old Photo -->
                <div class="text-center">
                    <p class="fw-semibold">Old</p>
                    @if($post->postphoto)
                        <img src="{{ asset('storage/' . $post->postphoto) }}" 
                             alt="Current Image" 
                             class="img-fluid rounded border" 
                             style="max-height: 200px;">
                    @else
                        <p class="text-muted">No Image</p>
                    @endif
                </div>

                <!-- Arrow Divider -->
                <div class="fw-bold fs-4">→</div>

                <!-- New Photo Preview -->
                <div class="text-center">
                    <p class="fw-semibold">New</p>
                    <img id="newPhotoPreview" 
                         class="img-fluid rounded border" 
                         style="max-height: 200px; display:none;">
                </div>

            </div>

            <!-- File Input -->
            <input type="file" name="postphoto" id="postphotoInput" 
                   class="form-control @error('postphoto') is-invalid @enderror">
            @error('postphoto')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Content -->
        <div class="mb-3">
            <label for="content" class="form-label fw-semibold">Content</label>
            <textarea name="content" id="content" rows="10" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $post->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit -->
        <div class="mb-5">
            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">Update Post</button>
            <a href="{{ route('blog.show', $post->id) }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">Cancel</a>
        </div>

    </form>
</div>

<!-- Live Preview Script -->
<script>
document.getElementById('postphotoInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('newPhotoPreview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
