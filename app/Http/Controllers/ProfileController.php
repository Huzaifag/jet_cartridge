<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile.index', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:1000',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
            $user->password = Hash::make($validated['new_password']);
        }

        if ($request->hasFile('profile_picture')) {
            try {
                $file = $request->file('profile_picture');
                $filename = time() . '_' . $file->getClientOriginalName();
                
                // Store the file in the public storage
                $path = $file->storeAs('profile_pictures', $filename, 'public');
                
                // Delete old profile picture if it exists
                if ($user->profile_picture) {
                    Storage::disk('public')->delete('profile_pictures/' . $user->profile_picture);
                }
                
                $user->profile_picture = $filename;
            } catch (\Exception $e) {
                \Log::error('Profile picture upload error: ' . $e->getMessage());
                return back()->withErrors(['profile_picture' => 'Failed to upload profile picture.']);
            }
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->bio = $validated['bio'] ?? $user->bio;
        
        try {
            $user->save();
            return back()->with('status', 'Profile updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Profile update error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to update profile.']);
        }
    }
} 