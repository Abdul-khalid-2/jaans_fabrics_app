<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountingReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function balanceSheet()
    {
        return view('dashboard.accounts.reports.balance-sheet');
    }
    public function incomeStatement()
    {
        return view('dashboard.accounts.reports.income-statement');
    }
    public function cashFlow()
    {
        return view('dashboard.accounts.reports.cash-flow');
    }
    public function receivablesAging()
    {
        return view('dashboard.accounts.reports.receivables-aging');
    }
    public function payablesAging()
    {
        return view('dashboard.accounts.reports.payables-aging');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
