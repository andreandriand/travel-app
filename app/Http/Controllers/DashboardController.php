<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pending = Transaction::where('transaction_status', 'PENDING')->count();
        $success = Transaction::where('transaction_status', 'SUCCESS')->count();
        $cancel = Transaction::where('transaction_status', 'CANCEL')->count();
        $transactions = Transaction::all()->count();
        $users = User::all()->count();
        $balance = Transaction::sum('transaction_total');
        return view('pages.admin.index', [
            'pending' => $pending,
            'success' => $success,
            'cancel' => $cancel,
            'transactions' => $transactions,
            'users' => $users,
            'balance' => $balance
        ]);
    }

    public function profile()
    {
        return view('pages.admin.profile');
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
