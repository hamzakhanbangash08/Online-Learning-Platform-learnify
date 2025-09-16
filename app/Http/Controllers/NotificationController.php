<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('admin.message', compact('notifications'));
    }

    // Mark single notification as read
    public function read($id)
    {
        $notify = Notification::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $notify->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Notification marked as read.');
    }

    // Mark all as read
    public function readAll()
    {
        Notification::where('user_id', Auth::id())->update(['is_read' => true]);

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }
}
