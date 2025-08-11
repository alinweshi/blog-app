<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;


class AdminNotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::guard('admin')->user()->notifications()->latest()->paginate(20);

        return view('admin.notifications.index', compact('notifications'));
    }
}
