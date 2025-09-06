<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Mail\AccountPersonCredentials;
use App\Models\AccountPerson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AccountPersonController extends Controller
{
    public function index()
    {
        $accountPersons = auth()->user()->accountPersons()->latest()->paginate();
        return view('seller.account-persons.index', compact('accountPersons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:account_persons'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:6'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $accountPerson = AccountPerson::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'visible_password' => $request->password,
            'seller_id' => auth()->id(),
            'status' => $request->status,
        ]);

        try {
            Mail::to($accountPerson->email)->send(new AccountPersonCredentials($accountPerson));
            $message = 'Account person created successfully. Login credentials have been sent to their email.';
        } catch (\Exception $e) {
            $message = 'Account person created successfully, but failed to send email. Please provide the credentials manually.';
        }

        return redirect()->route('seller.account-persons.index')
            ->with('success', $message);
    }

    public function show(AccountPerson $accountPerson)
    {
        return view('seller.account-persons.show', compact('accountPerson'));
    }

    public function update(Request $request, AccountPerson $accountPerson)
    {
        $this->authorize('update', $accountPerson);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:account_persons,email,' . $accountPerson->id],
            'phone' => ['required', 'string', 'max:20'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $accountPerson->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);

        return redirect()->route('seller.account-persons.index')
            ->with('success', 'Account person updated successfully.');
    }

    public function destroy(AccountPerson $accountPerson)
    {
        $this->authorize('delete', $accountPerson);

        $accountPerson->delete();

        return redirect()->route('seller.account-persons.index')
            ->with('success', 'Account person deleted successfully.');
    }

    public function resetPassword(AccountPerson $accountPerson)
    {
        $this->authorize('update', $accountPerson);

        $password = Str::random(8);

        $accountPerson->update([
            'password' => Hash::make($password),
            'visible_password' => $password,
        ]);

        try {
            Mail::to($accountPerson->email)->send(new AccountPersonCredentials($accountPerson));
            $message = 'Password reset successfully. New credentials have been sent to their email.';
        } catch (\Exception $e) {
            $message = 'Password reset successfully, but failed to send email. Please provide the new credentials manually.';
        }

        return redirect()->route('seller.account-persons.index')
            ->with('success', $message);
    }
}
