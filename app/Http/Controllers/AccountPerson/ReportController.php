<?php

namespace App\Http\Controllers\AccountPerson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('account-person.reports.index', [
            'reports' => [], // Replace with actual report data
        ]);
    }
} 