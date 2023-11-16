<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Http\Request;
use App\Mail\TransactionSuccess;
use Illuminate\Support\Facades\Mail;
use App\Models\Transaction;

class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {
        // set configuration midtrans

        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        // create instance midtrans notification

        $notification = new Notification();

        // explode id for database
        $order = explode('-', $notification->order_id);

        // assign variable for all parameter from midtrans

        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $order[1];

        // search transaction by id

        $transaction = Transaction::findOrFail($order_id);

        // handle notification status midtrans

        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->transaction_status = 'CHALLENGE';
                } else {
                    $transaction->transaction_status = 'SUCCESS';
                }
            }
        } else if ($status == 'settlement') {
            $transaction->transaction_status = 'SUCCESS';
        } else if ($status == 'pending') {
            $transaction->transaction_status = 'PENDING';
        } else if ($status == 'deny') {
            $transaction->transaction_status = 'FAILED';
        } else if ($status == 'expire') {
            $transaction->transaction_status = 'EXPIRED';
        } else if ($status == 'cancel') {
            $transaction->transaction_status = 'CANCELLED';
        }

        // save transaction

        $transaction->save();

        // send email notification

        if ($transaction) {
            if ($status == 'capture' && $fraud == 'accept') {
                Mail::to($transaction->user)->send(new TransactionSuccess($transaction));
            } elseif ($status == 'settlement') {
                Mail::to($transaction->user)->send(new TransactionSuccess($transaction));
            } elseif ($status == 'success') {
                Mail::to($transaction->user)->send(new TransactionSuccess($transaction));
            } elseif ($status == 'capture' && $fraud == 'challenge') {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment Challenge'
                    ]
                ]);
            } else {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans Payment not Settlement'
                    ]
                ]);
            }

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans Notification Success'
                ]
            ]);
        }
    }

    public function finishRedirect(Request $request)
    {
        return view('pages.frontend.success');
    }

    public function unfinishRedirect(Request $request)
    {
        return view('pages.frontend.unfinish');
    }

    public function errorRedirect(Request $request)
    {
        return view('pages.frontend.failed');
    }
}
