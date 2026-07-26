<?php

namespace App\Services;

use App\Models\Donation;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PalPlussService
{
    public function stkPush(Donation $donation)
    {
        try {

            $apiKey = config('palpluss.api_key');

if (empty($apiKey)) {

    Log::error('PALPLUSS_API_KEY is missing.');

    return back()->with(
        'error',
        'Payment service is not configured. Please contact the administrator.'
    );

}

$response = Http::withBasicAuth(
    $apiKey,
    ''
)->post(
    config('palpluss.base_url') . '/payments/stk',
    [
        'amount' => (float) $donation->amount,

        'phone' => $donation->phone,

        'accountReference' => 'YAFNET',

        'transactionDesc' => 'Donation',

        'channelId' => config('palpluss.channel_id'),

        'callbackUrl' => route('palpluss.callback'),
    ]
);

            $result = $response->json();

            Log::info('PalPluss Response', $result);

            /*
            |--------------------------------------------------------------------------
            | API returned an error
            |--------------------------------------------------------------------------
            */

            if (!isset($result['success']) || $result['success'] !== true) {

                $message = $result['error']['message']
                    ?? 'Unable to initiate payment.';

                Log::error($message);

                return back()->with('error', $message);
            }

            /*
            |--------------------------------------------------------------------------
            | Save transaction ID
            |--------------------------------------------------------------------------
            */

            if (isset($result['data']['transactionId'])) {

                $donation->transaction_id = $result['data']['transactionId'];

                $donation->save();
            }

            return back()->with(
                'success',
                'STK Push sent successfully. Please complete payment on your phone.'
            );

        } catch (\Throwable $e) {

            Log::error($e->getMessage());

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }
}