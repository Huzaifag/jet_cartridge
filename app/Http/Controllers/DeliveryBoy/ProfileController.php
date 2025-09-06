<?php

namespace App\Http\Controllers\DeliveryBoy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showCompleteProfile()
    {
        return view('delivery-boy.complete-profile');
    }

    public function completeProfile(Request $request)
    {
        $request->validate([
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'emergency_contact' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
            'bio' => 'required|string',
            'profile_picture' => 'nullable|image|max:2048',
            'previous_company' => 'required|string',
            'previous_position' => 'required|string',
            'previous_employment_start' => 'required|date',
            'previous_employment_end' => 'required|date|after:previous_employment_start',
            'work_experience' => 'required|string',
            'years_of_experience' => 'required|integer|min:0',
            'vehicle_type' => 'required|in:motorcycle,car,bicycle,van',
            'license_number' => 'required|string',
            'license_expiry' => 'required|date|after:today'
        ]);

        $user = auth()->user();
        $data = $request->except('profile_picture');

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }

        $data['is_profile_completed'] = true;
        $user->update($data);

        return redirect()->route('delivery-boy.dashboard')
            ->with('success', 'Profile completed successfully!');
    }

    public function index()
    {
        $user = auth()->user();
        return view('delivery-boy.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:delivery_boys,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'emergency_contact' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
            'bio' => 'required|string',
            'profile_picture' => 'nullable|image|max:2048',
            'previous_company' => 'required|string',
            'previous_position' => 'required|string',
            'previous_employment_start' => 'required|date',
            'previous_employment_end' => 'required|date|after:previous_employment_start',
            'work_experience' => 'required|string',
            'years_of_experience' => 'required|integer|min:0',
            'vehicle_type' => 'required|in:motorcycle,car,bicycle,van',
            'license_number' => 'required|string',
            'license_expiry' => 'required|date|after:today'
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        $user->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
} 