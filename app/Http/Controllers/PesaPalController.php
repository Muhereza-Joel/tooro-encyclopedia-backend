<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PesaPalController extends Controller
{
    public function ipn(Request $request)
    {
        Log::info('Received PesaPal IPN:', $request->all());

        return response()->json(['message' => 'IPN received'], 200);
    }

    public function callback(Request $request)
    {
        $trackingId = $request->query('OrderTrackingId');

        if (!$trackingId) {
            return redirect('/dashboard')->with('error', 'Missing tracking ID.');
        }

        $this->checkPaymentStatus($trackingId);

        return redirect('/dashboard')->with('message', 'Payment processed successfully.');
    }


    public function checkPaymentStatus(string $trackingId)
    {
        try {
            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . static::getPesaPalToken(),
                    'Content-Type' => 'application/json',
                ])
                ->get("https://pay.pesapal.com/v3/api/Transactions/GetTransactionStatus?orderTrackingId={$trackingId}");

            if ($response->successful()) {
                $data = $response->json();
                $status = $data['payment_status_description'] ?? 'Unknown';

                // Find booking by tracking ID
                $booking = Booking::where('order_tracking_id', $trackingId)->first();

                if ($booking) {
                    DB::transaction(function () use ($data, $status, $booking, $trackingId) {
                        // Update booking status if completed
                        if ($status === 'Completed') {
                            $booking->update(['status' => 'confirmed']);
                        }

                        // Create or update transaction record
                        Transaction::updateOrCreate(
                            ['trackingId' => $trackingId],
                            [
                                'currency' => $data['currency'] ?? 'UGX',
                                'amount' => $data['amount'] ?? 0,
                                'status' => $status,
                                'referenceNo' => $data['merchant_reference'] ?? null,
                                'paymentMethod' => $data['payment_method'] ?? null,
                                'booking_id' => $booking->id,
                            ]
                        );
                    });

                    Notification::make()
                        ->title('Payment Status')
                        ->success()
                        ->body("Payment status: {$status}")
                        ->send();
                } else {
                    Log::warning("No booking found with tracking ID: {$trackingId}");
                }
            } else {
                throw new \Exception('Failed to check payment status');
            }
        } catch (\Exception $e) {
            Log::error('Error checking payment status', ['error' => $e->getMessage()]);

            Notification::make()
                ->title('Error Checking Payment')
                ->danger()
                ->body($e->getMessage())
                ->send();
        }
    }

    protected static function getPesaPalToken(): string
    {
        $response = Http::withoutVerifying()
            ->post('https://pay.pesapal.com/v3/api/Auth/RequestToken', [
                'consumer_key' => config('services.pesapal.consumer_key'),
                'consumer_secret' => config('services.pesapal.consumer_secret'),
            ]);

        return $response->json('token');
    }
}
