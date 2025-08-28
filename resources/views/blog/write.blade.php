@extends('layouts.app')

@section('title', 'Write a New Post — STARBLOG')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Write a New Blog Post</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Post Title</label>
            <input type="text" name="title" id="title" class="form-control"
                   placeholder="Enter your Blog title" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="subtitle" class="form-label">Post Sub Title</label>
            <input type="text" name="subtitle" id="subtitle" class="form-control"
                   placeholder="Enter your Blog subtitle" value="{{ old('subtitle') }}" >
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Blog Category</label>
            <select name="category_id" id="category" class="form-control" required>
                <option value="" disabled selected hidden>-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="mb-3">
            <label for="content" class="form-label">Post Content</label>
            <textarea name="content" id="content" class="form-control" rows="6" placeholder="Write your post..." required>{{ old('content') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="postphoto" class="form-label">Post Image</label>
            <input type="file" name="postphoto" id="postphoto" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary" onclick="this.disabled=true; this.form.submit();>Publish Post</button>
    </form>
</div>
@endsection
