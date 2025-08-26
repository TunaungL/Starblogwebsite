<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|unique:users|max:225',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|string|min:8|confirmed',
            'role' => 'required|string'
        ]);

        User::create([
             'name' => $request->name,
             'email'=> $request->email,
             'password'=> Hash::make($request->password),
             'role' => $request->role
        ]);

        return redirect()->route('admin.users.index')->with('success','UserCreatedSuccessful');
    }
    
   

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
         $request->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $user->id,
            'role' => 'required|in:user,admin'
        ]);

        $user->update([
            'name' => $request->name,
            'role' => $request->role
        ]);
        return redirect()->route('admin.users.index')->with('success','UserEditSuccessful');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return redirect()->route('admin.users.index')->with('success','User Deleted');
    }
}
