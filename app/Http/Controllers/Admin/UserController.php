<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Livewire\UserSearch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function search(Request $request)
    {
        // Logic to handle user search can be added here
        return UserSearch::render();
    }
    public function posts(User $user)
    {
        $posts = $user->posts; // Assuming User model has a posts relationship
        // Logic to show posts for the user
        return view('admin.users.posts', ['user' => $user, 'posts' => $posts]);
    }
}
