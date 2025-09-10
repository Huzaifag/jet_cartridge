<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('seller.auth.register');
    }

    public function processStep1(Request $request)
    {
        try {
            $validated = $request->validate([
                'company_name' => 'required|string|max:255',
                'company_registration_number' => 'required|string|max:255',
                'company_address' => 'required|string',
                'company_city' => 'required|string|max:255',
                'company_state' => 'required|string|max:255',
                'company_country' => 'required|string|max:255',
                'company_postal_code' => 'required|string|max:20',
                'company_phone' => 'required|string|max:20',
                'company_website' => 'nullable|url|max:255',
            ]);

            session(['seller_registration_step1' => $validated]);
            return response()->json(['success' => true, 'message' => 'Step 1 completed']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function processStep2(Request $request)
    {
        try {
            $validated = $request->validate([
                'contact_person_name' => 'required|string|max:255',
                'contact_person_position' => 'required|string|max:255',
                'contact_person_email' => 'required|email|unique:sellers,contact_person_email',
                'contact_person_phone' => 'required|string|max:20',
                'business_type' => 'required|string|max:255',
                'main_products' => 'required|json',
                'years_in_business' => 'required|integer|min:0',
                'number_of_employees' => 'required|string',
                'annual_revenue' => 'required|string',
                'email' => 'required|email|unique:sellers,email',
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);

            $validated['main_products'] = json_decode($validated['main_products'], true);
            
            // Store the password separately to ensure it's not lost
            $password = Hash::make($validated['password']);
            unset($validated['password']); // Remove from validated data
            
            session([
                'seller_registration_step2' => $validated,
                'seller_registration_password' => $password
            ]);
            
            return response()->json(['success' => true, 'message' => 'Step 2 completed']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function processStep3(Request $request)
    {
        try {
            $validated = $request->validate([
                'business_license' => [
                    'required',
                    'file',
                    'mimes:pdf,jpg,jpeg,png',
                    'max:2048',
                ],
                'tax_certificate' => [
                    'required',
                    'file',
                    'mimes:pdf,jpg,jpeg,png',
                    'max:2048',
                ],
                'id_proof' => [
                    'required',
                    'file',
                    'mimes:pdf,jpg,jpeg,png',
                    'max:2048',
                ],
                'company_profile' => [
                    'nullable',
                    'file',
                    'mimes:pdf',
                    'max:2048',
                ],
            ]);

            $step1Data = session('seller_registration_step1');
            $step2Data = session('seller_registration_step2');
            $password = session('seller_registration_password');

            if (!$step1Data || !$step2Data || !$password) {
                return response()->json([
                    'success' => false,
                    'errors' => ['general' => ['Previous steps data missing. Please start from step 1.']]
                ], 422);
            }

            // Store files
            $documentPaths = [];
            foreach ($validated as $key => $file) {
                if ($file && $file instanceof \Illuminate\Http\UploadedFile) {
                    try {
                        $path = $file->store('seller_documents', 'public');
                        if (!$path) {
                            throw new \Exception("Failed to store file: {$key}");
                        }
                        $documentPaths[$key] = $path;
                    } catch (\Exception $e) {
                        \Log::error('File upload error: ' . $e->getMessage());
                        return response()->json([
                            'success' => false,
                            'errors' => ['general' => ['Error uploading ' . $key . '. Please try again.']]
                        ], 500);
                    }
                }
            }

            try {
                // Merge all data and ensure password is included
                $sellerData = array_merge(
                    $step1Data,
                    $step2Data,
                    $documentPaths,
                    ['password' => $password]
                );

                // Create seller
                $seller = Seller::create($sellerData);

                // Clear session data
                session()->forget([
                    'seller_registration_step1',
                    'seller_registration_step2',
                    'seller_registration_password'
                ]);

                Auth::guard('seller')->login($seller);

                return response()->json([
                    'success' => true,
                    'message' => 'Registration completed successfully',
                    'redirect' => route('seller.dashboard')
                ]);
            } catch (\Exception $e) {
                // If seller creation fails, delete uploaded files
                foreach ($documentPaths as $path) {
                    Storage::disk('public')->delete($path);
                }
                \Log::error('Seller creation error: ' . $e->getMessage());
                throw $e;
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Seller registration error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'errors' => ['general' => [$e->getMessage()]]
            ], 500);
        }
    }

    public function showLoginForm()
    {
        if (auth('seller')->check() || auth('employee')->check()) {
            return redirect('/');
        }
        return view('seller.auth.login');
    }

    public function login(Request $request)
    {
        if (auth('seller')->check() || auth('employee')->check()) {
            return redirect('/');
        }
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('seller')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('seller.employees.index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('seller')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('seller.login');
    }
} 