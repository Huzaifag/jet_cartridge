<?php

namespace App\Http\Controllers\DeliveryBoy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:delivery_boy');
    }

    public function index()
    {
        $deliveryBoy = auth()->user();
        
        $stats = [
            'total_deliveries' => $deliveryBoy->deliveries()->count(),
            'completed_today' => $deliveryBoy->deliveries()
                ->where('status', 'delivered')
                ->whereDate('updated_at', today())
                ->count(),
            'pending_deliveries' => $deliveryBoy->deliveries()
                ->whereIn('status', ['pending', 'picked_up', 'in_transit'])
                ->count()
        ];

        $recent_deliveries = $deliveryBoy->deliveries()
            ->latest()
            ->take(5)
            ->get();

        return view('delivery-boy.dashboard', compact('stats', 'recent_deliveries'));
    }
} 