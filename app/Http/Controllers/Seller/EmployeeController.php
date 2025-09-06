<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = auth()->guard('seller')->user()->employees()
            ->where('email', '!=', auth()->guard('seller')->user()->email)
            ->latest()
            ->paginate(10);
        return view('seller.employees.index', compact('employees'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:employees,email',
                'position' => 'required|string|max:255',
                'password' => 'required|string|min:8',
                'permissions' => 'nullable|array',
                'permissions.*' => 'string|in:manage_products,manage_orders,view_analytics'
            ]);

            // Ensure permissions is an array
            $validated['permissions'] = $validated['permissions'] ?? [];

            $employee = Employee::create([
                'seller_id' => auth()->guard('seller')->id(),
                'name' => $validated['name'],
                'email' => $validated['email'],
                'position' => $validated['position'],
                'password' => $validated['password'], // The model will handle hashing
                'permissions' => $validated['permissions'],
                'is_active' => true
            ]);

            try {
                // Send email with login credentials
                Mail::send('emails.employee-credentials', [
                    'name' => $employee->name,
                    'email' => $employee->email,
                    'password' => $validated['password'],
                    'seller' => auth()->guard('seller')->user()->company_name
                ], function($message) use ($employee) {
                    $message->to($employee->email)
                           ->subject('Your Employee Account Credentials');
                });

                return response()->json([
                    'success' => true,
                    'message' => 'Employee added successfully. Login credentials have been sent to their email.',
                    'employee' => $employee
                ]);

            } catch (Exception $e) {
                Log::error('Failed to send employee credentials email: ' . $e->getMessage(), [
                    'employee_id' => $employee->id,
                    'error' => $e->getMessage()
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Employee added successfully, but there was an issue sending the email. Please provide the credentials manually.',
                    'employee' => $employee
                ]);
            }

        } catch (Exception $e) {
            Log::error('Failed to create employee: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'request' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding the employee. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Employee $employee)
    {
        try {
            // $this->authorize('update', $employee);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'permissions' => 'required|array',
                'permissions.*' => 'string|in:manage_products,manage_orders,view_analytics',
                'is_active' => 'required|boolean'
            ]);

            $employee->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Employee updated successfully',
                'employee' => $employee
            ]);
        } catch (Exception $e) {
            Log::error('Failed to update employee: ' . $e->getMessage(), [
                'employee_id' => $employee->id,
                'error' => $e->getMessage(),
                'request' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the employee. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Employee $employee)
    {
        try {
            $this->authorize('delete', $employee);

            $employee->delete();

            return response()->json([
                'success' => true,
                'message' => 'Employee removed successfully'
            ]);
        } catch (Exception $e) {
            Log::error('Failed to delete employee: ' . $e->getMessage(), [
                'employee_id' => $employee->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while removing the employee. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function resetPassword(Employee $employee)
    {
        try {
            $this->authorize('update', $employee);

            // Generate new password
            $password = Str::random(10);
            $employee->update([
                'password' => $password // The model will handle hashing
            ]);

            try {
                // Send email with new credentials
                Mail::send('emails.employee-password-reset', [
                    'name' => $employee->name,
                    'email' => $employee->email,
                    'password' => $password,
                    'seller' => auth()->guard('seller')->user()->company_name
                ], function($message) use ($employee) {
                    $message->to($employee->email)
                           ->subject('Your Account Password Has Been Reset');
                });
            } catch (Exception $e) {
                Log::error('Failed to send password reset email: ' . $e->getMessage(), [
                    'employee_id' => $employee->id,
                    'error' => $e->getMessage()
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Password reset successfully, but there was an issue sending the email. New password: ' . $password,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Password reset successfully. New credentials have been sent to employee\'s email.'
            ]);
        } catch (Exception $e) {
            Log::error('Failed to reset employee password: ' . $e->getMessage(), [
                'employee_id' => $employee->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while resetting the password. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getEmployee($id)
    {
        try {
            $employee = Employee::where('seller_id', auth()->guard('seller')->id())->where('id', $id)->firstOrFail();
            return response()->json($employee);
        } catch (Exception $e) {
            Log::error('Failed to fetch employee: ' . $e->getMessage(), [
                'employee_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching the employee details. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
