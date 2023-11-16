<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TravelPackage;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Mail\TransactionSuccess;
use Illuminate\Support\Facades\Mail;

use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $transactions = Transaction::with(['details', 'travel_package', 'user'])->findOrFail($id);

        return view('pages.frontend.checkout', [
            'transactions' => $transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, string $id)
    {
        $data = $request->validate([
            'username' => 'required|string',
            'nationality' => 'required|string',
            'is_visa' => 'required|boolean',
            'doe_passport' => 'required|date'
        ]);

        $data['transactions_id'] = $id;

        TransactionDetail::create($data);

        $transaction = Transaction::with(['travel_package'])->find($id);

        if ($request->is_visa) {
            $transaction->transaction_total += 500000;
            $transaction->additional_visa += 500000;
        }

        $transaction->transaction_total += $transaction->travel_package->price;

        $transaction->save();

        return redirect()->route('checkout.package', $id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $package = TravelPackage::findOrFail($id);

        $transaction = Transaction::create([
            'travel_package_id' => $package->id,
            'user_id' => auth()->user()->id,
            'additional_visa' => 0,
            'transaction_total' => $package->price + $request->additional_visa,
            'transaction_status' => 'IN_CART'
        ]);

        TransactionDetail::create([
            'transactions_id' => $transaction->id,
            'username' => auth()->user()->name,
            'nationality' => 'ID',
            'is_visa' => false,
            'doe_passport' => Carbon::now()->addYears(5)
        ]);

        return redirect()->route('checkout.package', $transaction->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::with(['details', 'travel_package.galleries', 'user'])
            ->findOrFail($id);

        $transaction->transaction_status = 'PENDING';

        $transaction->save();

        // Midtrans Configuration

        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        // Midtrans Transaction

        $midtrans_params = [
            'transaction_details' => [
                'order_id' => 'TRAVEL-' . $transaction->id,
                'gross_amount' => (int) $transaction->transaction_total
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email
            ],
            'enabled_payments' => [
                'gopay', 'bank_transfer'
            ],
            'vtweb' => []
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;

            // Redirect to Snap Payment Page
            header('Location:' . $paymentUrl);
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        // Mail::to($transaction->user)->send(new TransactionSuccess($transaction));

        // return view('pages.frontend.success');
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
    public function destroy(string $detail_id)
    {
        $transaction_detail = TransactionDetail::findOrFail($detail_id);

        $transaction = Transaction::with(['details', 'travel_package'])
            ->findOrFail($transaction_detail->transactions_id);

        if ($transaction_detail->is_visa) {
            $transaction->transaction_total -= 500000;
            $transaction->additional_visa -= 500000;
        }

        $transaction->transaction_total -= $transaction->travel_package->price;

        $transaction->save();

        $transaction_detail->delete();

        return redirect()->route('checkout.package', $transaction_detail->transactions_id);
    }
}
