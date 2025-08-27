<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;

// Landing page
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('blog.index');
    }
    return view('welcome');
});
Route::get('/search', [PostController::class, 'search'])->name('search');

// Profile routes (auth required)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Register/Login
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
Route::post('/posts/{post}/comment', [PostController::class, 'comment'])->name('posts.comment');

// Google OAuth
Route::get('auth/google', [App\Http\Controllers\Auth\RegisterController::class, 'redirectToGoogle'])->name('googleregister');
Route::get('auth/google/callback', [App\Http\Controllers\Auth\RegisterController::class, 'handleGoogleCallback']);

Route::prefix('admin')->name('admin.')->middleware([AdminMiddleware::class])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Posts
    Route::get('posts', [PostController::class, 'adminIndex'])->name('posts.index');
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create'); // s add post
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('admin/posts/create', [PostController::class, 'create'])->name('admin.posts.create'); // admin add post
    Route::post('admin/posts', [PostController::class, 'store'])->name('admin.posts.store')->middleware([AdminMiddleware::class]);
    Route::get('posts/{post}/edit', [PostController::class, 'adminEdit'])->name('posts.edit');
    Route::put('posts/{post}', [PostController::class, 'adminUpdate'])->name('posts.update');
    Route::delete('posts/{post}', [PostController::class, 'adminDestroy'])->name('posts.destroy');

    // Users
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Categories
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

// Blog routes (public/auth)
Route::resource('blog', PostController::class)->parameters(['blog' => 'post'])
    ->middleware('auth');
