@extends('layouts.admin')

@section('title', 'Write a New Post — STARBLOG')

@section('content')
<div class="container py-4">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Write a New Blog Post</h5>
        </div>
        <div class="card-body">

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Post Title</label>
                    <input type="text" name="title" id="title" class="form-control"
                           placeholder="Enter your Blog title" value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label for="subtitle" class="form-label">Post Sub Title</label>
                    <input type="text" name="subtitle" id="subtitle" class="form-control"
                           placeholder="Enter your Blog subtitle" value="{{ old('subtitle') }}">
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Blog Category</label>
                    <select name="category_id" id="category" class="form-select" required>
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
                    <textarea name="content" id="content" class="form-control" rows="8" placeholder="Write your post..." required>{{ old('content') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="postphoto" class="form-label">Post Image</label>
                    <input type="file" name="postphoto" id="postphoto" class="form-control" accept="image/*" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-dark">Publish Post</button>
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Cancel</a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
