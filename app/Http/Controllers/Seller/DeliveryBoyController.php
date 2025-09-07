<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\DeliveryBoy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class DeliveryBoyController extends Controller
{
    public function index()
    {
        $deliveryBoys = auth('seller')->user()->deliveryBoys()->latest()->paginate();
        return view('seller.delivery-boys.index', compact('deliveryBoys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:delivery_boys'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:6'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $deliveryBoy = DeliveryBoy::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'visible_password' => $request->password,
            'seller_id' => auth()->id(),
            'status' => $request->status,
        ]);

        return redirect()->route('seller.delivery-boys.index')
            ->with('success', 'Delivery boy created successfully.');
    }

    public function show(DeliveryBoy $deliveryBoy)
    {
        $this->authorize('view', $deliveryBoy);
        return view('seller.delivery-boys.show', compact('deliveryBoy'));
    }

    public function update(Request $request, DeliveryBoy $deliveryBoy)
    {
        $this->authorize('update', $deliveryBoy);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:delivery_boys,email,' . $deliveryBoy->id],
            'phone' => ['required', 'string', 'max:20'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $deliveryBoy->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);

        return redirect()->route('seller.delivery-boys.index')
            ->with('success', 'Delivery boy updated successfully.');
    }

    public function destroy(DeliveryBoy $deliveryBoy)
    {
        $this->authorize('delete', $deliveryBoy);

        $deliveryBoy->delete();

        return redirect()->route('seller.delivery-boys.index')
            ->with('success', 'Delivery boy deleted successfully.');
    }

    public function resetPassword(DeliveryBoy $deliveryBoy)
    {
        $this->authorize('update', $deliveryBoy);

        $password = Str::random(8);

        $deliveryBoy->update([
            'password' => Hash::make($password),
            'visible_password' => $password,
        ]);

        return redirect()->route('seller.delivery-boys.index')
            ->with('success', 'Password reset successfully.');
    }
}
