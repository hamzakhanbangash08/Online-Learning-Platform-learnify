<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class profileUpdateController extends Controller
{
    //

   function create()
{
    $user = Auth::user();
    return view('admin.profile', compact('user'));
}

    // Profile update
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'cnic' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update fields
        $user->name = $request->name;
        $user->city = $request->city;
        $user->cnic = $request->cnic;

        // Agar new image upload hui hai
        if ($request->hasFile('image')) {
            // Purani image delete kar do
            if ($user->image && Storage::exists('public/' . $user->image)) {
                Storage::delete('public/' . $user->image);
            }

            // New image store
            $path = $request->file('image')->store('profile_images', 'public');
            $user->image = $path;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    // Password update
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Validation
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Check old password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        // New password set
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password changed successfully.');
    }
}
