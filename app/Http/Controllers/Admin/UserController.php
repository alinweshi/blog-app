<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Livewire\UserSearch;
use Illuminate\Http\Request;

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
}
