<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $employee = auth()->user();
        return view('employee.profile.index', compact('employee'));
    }

    public function update(Request $request)
    {
        $employee = auth()->user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'profile_picture' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($employee->profile_picture) {
                Storage::delete($employee->profile_picture);
            }
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $employee->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function addExperience(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $employee = auth()->user();
        
        $experiences = $employee->work_experience ?? [];
        $experiences[] = $validated;
        
        $employee->update(['work_experience' => $experiences]);

        return back()->with('success', 'Work experience added successfully.');
        }

    public function updateSkills(Request $request)
    {
        $validated = $request->validate([
            'skills' => 'required|string|max:1000'
        ]);

        $skills = array_map('trim', explode(',', $validated['skills']));
        $skills = array_filter($skills); // Remove empty values

        $employee = auth()->user();
        $employee->update(['skills' => $skills]);

        return back()->with('success', 'Skills updated successfully.');
    }

    public function publicProfile($employee)
    {
        $employee = Employee::with(['products' => function($query) {
            $query->latest()->take(5);
        }])->findOrFail($employee);

        return view('employee.profile.public', compact('employee'));
    }

    public function follow(Employee $employee)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to follow employees.');
        }

        $user = auth()->user();
        
        if (!$employee->isFollowedBy($user)) {
            $employee->followers()->attach($user->id);
            return back()->with('success', 'You are now following ' . $employee->name);
        }

        return back()->with('info', 'You are already following ' . $employee->name);
    }

    public function unfollow(Employee $employee)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to unfollow employees.');
        }

        $user = auth()->user();
        
        if ($employee->isFollowedBy($user)) {
            $employee->followers()->detach($user->id);
            return back()->with('success', 'You have unfollowed ' . $employee->name);
        }

        return back()->with('info', 'You are not following ' . $employee->name);
    }
} 