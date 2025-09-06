<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Lead;
use App\Models\LeadAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadsController extends Controller
{
    public function index(){
        $leads = Lead::with('customer', 'product', 'seller')->latest()->where('seller_id', Auth::user()->id)->paginate(10);
        // $products = Product::all();
        $employees = Employee::where('seller_id', Auth::user()->id)->with('leadAssignments')->get();
        
        return view('seller.leads.index', compact('leads', 'employees'));
    }



    public function show($id){
        $lead = Lead::with('customer', 'product', 'seller')->findOrFail($id);
        return view('seller.leads.show', compact('lead'));
    }

    public function assign(Request $request){
        $request->validate([
            'lead_id' => 'required',
            'employee_id' => 'required',
            'priority' => 'required',
            'notes' => 'required',
        ]);
        LeadAssignment::create([
            'lead_id' => $request->lead_id,
            'employee_id' => $request->employee_id,
            'priority' => $request->priority,
            'notes' => $request->notes,
        ]);
        return redirect()->back()->with('success', 'Lead assigned successfully');
    }
}
