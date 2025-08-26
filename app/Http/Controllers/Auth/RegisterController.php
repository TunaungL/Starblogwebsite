<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

 use Illuminate\Support\Facades\Auth;




class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register'); // show registration form
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|string|min:8|confirmed',
        ]);

       $user=User::create([
             'name' => $request->name,
             'email'=> $request->email,
             'password'=> Hash::make($request->password)
        ]);
         Auth::login($user);

        return redirect()->route('blog.index')->with('success','Account Created Successfully');
    }

     // Redirect to Google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google callback
    public function handleGoogleCallback()
    {
       $googleUser = Socialite::driver('google')->user();


        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => bcrypt(Str::random(16)),
            ]
        );

       Auth::login($user);


        return redirect('/blogs'); // change to your post-login page
    }
}

