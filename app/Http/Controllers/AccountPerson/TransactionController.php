<?php

namespace App\Http\Controllers\AccountPerson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('account-person.transactions.index', [
            'transactions' => [], // Replace with actual transaction data
        ]);
    }
} 