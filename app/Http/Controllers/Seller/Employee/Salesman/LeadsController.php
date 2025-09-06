<?php

namespace App\Http\Controllers\Seller\Employee\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Lead;
use App\Models\LeadAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Empty_;

class LeadsController extends Controller
{
    public function index(){

        
        $seller_id = auth('employee')->user()->seller_id;
        $leads = Lead::with('customer', 'product', 'seller')->latest()->where('seller_id', $seller_id)->paginate(10);
        // $products = Product::all();
        $employees = Employee::where('seller_id', $seller_id)->with('leadAssignments')->get();
        
        return view('Employees.salesman.leads.index', compact('leads', 'employees'));
    }



    public function show($id){
        $lead = Lead::with('customer', 'product', 'seller')->findOrFail($id);
        return view('Employees.salesman.leads.show', compact('lead'));
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
