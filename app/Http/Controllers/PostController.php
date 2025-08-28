<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display all posts.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::with(['user','category','likes',
                // Load only the latest 4 comments with each post
                        'comments' => function($q) {
                            $q->latest()->take(4);
                        },
                 'comments.user'])
            ->withCount('comments') // Get total comments coun
            ->when($query, function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        $popularTags = ['AI','Web Dev','Design','Business']; // example

        return view('blog.index', compact('posts','popularTags','query'));
    }
    

    public function search(Request $request)
{
    $query = $request->input('q');

    $posts = Post::where('title', 'like', "%{$query}%")
                 ->orWhere('content', 'like', "%{$query}%")
                 ->latest()
                 ->paginate(6)            // <-- paginate instead of get
                 ->withQueryString();     // <-- keep ?q= in pagination links

    $popularTags = ['AI','Web Dev','Design','Business']; // example

    return view('blog.index', compact('posts', 'query', 'popularTags'));
}


    /**
     * Show the form for creating a new post.
     */
    public function create(Request $request)
    {
         $categories = \App\Models\Category::all(); // get all categories
           // detect if admin
    $isAdmin = $request->routeIs('admin.*');

    // return different views if needed
    if ($isAdmin) {
        return view('admin.posts.create', compact('categories'));
    }

       return view('blog.write', compact('categories'));
        
    }

    /**
     * Store a new post.
     */
   public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'title' => 'required|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'content' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'postphoto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $postPhoto = null;

    if ($request->hasFile('postphoto')) {
        $file = $request->file('postphoto');

        // Generate safe filename -> slug + timestamp + id + extension
        $filename = \Str::slug($request->title) . '-' . time() . '.' . uniqid() . '.'. $file->getClientOriginalExtension();

        // Store with custom name
        $postPhoto = $file->storeAs('post_photos', $filename, 'public');
    }
    // Check duplicate post 
            $exists = Post::where('title', $request->title)->where('user_id', Auth::id())->first();
        if ($exists) {
            return redirect()->back()->with('error', 'You already created a post with this title.');
        }


    Post::create([
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'content' => $request->content,
        'postphoto' => $postPhoto,   // <-- stores "post_photos/filename.jpg"
        'user_id' => Auth::id(),
        'category_id' => $request->category_id,
    ]);

    if ($request->routeIs('admin.*')) {
        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }

    return redirect()->route('blog.index')->with('success', 'Post created successfully!');
}

    /**
     * Display a single post.
     */
    // Like a post
public function like(Post $post) {
    $user = auth()->user();
    $like = $post->likes()->where('user_id', $user->id)->first();
    if ($like) {
        $like->delete();
    } else {
        $post->likes()->create(['user_id' => $user->id]);
    }
    return back();
}

// Store comment
 public function comment(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string|max:1000', // must match textarea name & column
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return back();
    }

    
  public function show($id)
{
    $post = Post::with(['category','user'])->findOrFail($id);
            
    $relatedposts = Post::where('category_id',$post->category_id)  // the category id and category of post must match
                        ->where('id', '!=', $post->id)     // the category id that find must not be the post category
                        ->latest()  // take latest
                        ->take(3)   // take only 3
                        ->get();

    $authorposts = Post::where('user_id',$post->user_id)
                      ->where('id', '!=',$post->id)
                      ->latest()
                      ->take(3)
                      ->get();
    return view('blog.show', compact('post','relatedposts','authorposts'));
}



    /**
     * Show form to edit a post.
     */
  public function edit(Post $post)
{
    $user = auth()->user();

    // If the user is not admin and not the owner, deny access
    if ($user->role !== 'admin' && $post->user_id !== $user->id) {
        return redirect()->back()->with('error', 'You cannot edit this post.');
    }

    $categories = \App\Models\Category::all();
    return view('blog.edit', compact('post', 'categories'));
}


    /**
     * Update a post.
     */
            public function update(Request $request, Post $post)
        {
            $user = auth()->user();

            // Authorization check
            if ($user->role !== 'admin' && $post->user_id !== $user->id) {
                return redirect()->back()->with('error', 'You cannot update this post.');
            }

            $request->validate([
                'title' => 'required|string|max:255',
                'subtitle' => 'nullable|string|max:255',
                'content' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'postphoto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            if ($request->hasFile('postphoto')) {
                // Delete old photo if exists
                if ($post->postphoto && \Storage::disk('public')->exists($post->postphoto)) {
                    \Storage::disk('public')->delete($post->postphoto);
                }

                $file = $request->file('postphoto');
                $filename = \Str::slug($request->title) . '-' . time() . '.' . $file->getClientOriginalExtension();
                $post->postphoto = $file->storeAs('post_photos', $filename, 'public');
            }

            $post->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'postphoto' => $post->postphoto,
            ]);

            return redirect()->route('profile.index')->with('success', 'Post updated successfully!');
        }




    /**
     * Delete a post.
     */
    public function destroy(Post $post)
{
    $user = auth()->user();

    // Only admin or the post owner can delete
    if ($user->role !== 'admin' && $post->user_id !== $user->id) {
        return redirect()->back()->with('error', 'You cannot delete this post.');
    }

    if ($post->postphoto && \Storage::disk('public')->exists($post->postphoto)) {
        \Storage::disk('public')->delete($post->postphoto);
    }

    $post->delete();

    return redirect()->back()->with('success','Post deleted successfully!');
}


//Admin Section 

// Admin: List all posts
public function adminIndex()
{
    $posts = Post::with(['user','category'])->latest()->paginate(15);
    return view('admin.posts.index', compact('posts'));
}

// Admin: Edit post
public function adminEdit(Post $post)
{
    $categories = \App\Models\Category::all();
    return view('admin.posts.edit', compact('post','categories'));
}

// Admin: Update post
 public function adminUpdate(Request $request, Post $post)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'content' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'postphoto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    if ($request->hasFile('postphoto')) {
        // Delete old photo if exists
        if ($post->postphoto && \Storage::disk('public')->exists($post->postphoto)) {
            \Storage::disk('public')->delete($post->postphoto);
        }

        $file = $request->file('postphoto');
        $filename = \Str::slug($request->title) . '-' . time() . '.' . $file->getClientOriginalExtension();
        $post->postphoto = $file->storeAs('post_photos', $filename, 'public');
    }

    $post->update([
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'content' => $request->content,
        'category_id' => $request->category_id,
        'postphoto' => $post->postphoto,
    ]);

    return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully!');
}


// Admin: Delete post
public function adminDestroy(Post $post)
{
    if ($post->postphoto && \Storage::disk('public')->exists($post->postphoto)) {
        \Storage::disk('public')->delete($post->postphoto);
    }

    $post->delete();
    return redirect()->route('admin.posts.index')->with('success','Post deleted successfully!');
}


}
