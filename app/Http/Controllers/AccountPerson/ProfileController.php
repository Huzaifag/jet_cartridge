<?php

namespace App\Http\Controllers\AccountPerson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $accountPerson = Auth::user();
        return view('account-person.profile.index', compact('accountPerson'));
    }

    public function update(Request $request)
    {
        $accountPerson = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:account_persons,email,' . $accountPerson->id,
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'emergency_contact' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'bio' => 'required|string|max:1000',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($accountPerson->profile_picture) {
                Storage::delete($accountPerson->profile_picture);
            }
            
            // Store new profile picture
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        $accountPerson->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function showCompleteProfile()
    {
        return view('account-person.complete-profile');
    }

    public function completeProfile(Request $request)
    {
        $accountPerson = Auth::user();
        
        $validated = $request->validate([
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'emergency_contact' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'bio' => 'required|string|max:1000',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        $validated['is_profile_completed'] = true;
        $accountPerson->update($validated);

        return redirect()->route('account-person.dashboard')->with('success', 'Profile completed successfully.');
    }
} 