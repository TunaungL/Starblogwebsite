<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $postsCount = \App\Models\Post::count();
        $usersCount = \App\Models\User::count();
        $categoriesCount = \App\Models\Category::count();

        return view('admin.dashboard', compact('postsCount', 'usersCount', 'categoriesCount'));
    }
}
