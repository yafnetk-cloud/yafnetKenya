<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Services\PalPlussService;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    protected $palpluss;

    public function __construct(PalPlussService $palpluss)
    {
        $this->palpluss = $palpluss;
    }

    /**
     * Initiate donation payment
     */
    public function initiate(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email',
            'phone'  => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);

        // Save donation first
        $donation = Donation::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'amount'         => $request->amount,
            'status'         => 'pending',
            'payment_method' => 'M-Pesa',
        ]);

        // Initiate STK Push
        return $this->palpluss->stkPush($donation);
    }

    /**
     * PalPluss callback
     */
    public function callback(Request $request)
{
    $payload = $request->all();

    \Log::info('PalPluss Callback', $payload);

    $transaction = $payload['transaction'] ?? [];

    $donation = Donation::where(
        'transaction_id',
        $transaction['id'] ?? null
    )->first();

    if (!$donation) {
        return response()->json([
            'success' => false,
            'message' => 'Donation not found.'
        ], 404);
    }

    $status = strtoupper($transaction['status'] ?? '');

    switch ($status) {
        case 'SUCCESS':
            $donation->status = 'paid';
            break;

        case 'FAILED':
            $donation->status = 'failed';
            break;

        case 'CANCELLED':
            $donation->status = 'cancelled';
            break;

        default:
            $donation->status = 'pending';
            break;
    }

    $donation->save();

    return response()->json([
        'success' => true
    ]);
}
}