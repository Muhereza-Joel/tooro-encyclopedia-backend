<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Booking;
use Illuminate\Support\Facades\Http;
use Filament\Notifications\Notification;

class PesaPalPayment extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static string $view = 'filament.pages.pesa-pal-payment';

    public $bookingId;
    public $iframeUrl;

    // ✅ This prevents the page from showing in the sidebar
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public function mount(): void
    {
        $this->bookingId = request()->query('booking_id');

        if ($this->bookingId) {
            $booking = Booking::findOrFail($this->bookingId);

            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->getPesaPalToken(),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                ->post('https://pay.pesapal.com/v3/api/Transactions/SubmitOrderRequest', [
                    'id' => $booking->id,
                    'currency' => 'UGX',
                    // 'amount' => $booking->quantity * $booking->event->price,
                    'amount' => 500, // Assuming price is per booking
                    'description' => "Payment for {$booking->event->title} booking",
                    'callback_url' => route('pesapal.callback'),
                    'notification_id' => config('services.pesapal.ipn_id'),
                    'billing_address' => [
                        'email_address' => $booking->user->email,
                        'phone_number' => $booking->user->phone ?? '',
                        'first_name' => $booking->user->name,
                    ],
                ]);

            if ($response->successful()) {

                $booking->update([
                    'status' => 'pending',
                    'order_tracking_id' => $response->json('order_tracking_id'),

                ]);
                $this->iframeUrl = $response->json('redirect_url');
            } else {
                Notification::make()
                    ->title('PesaPal Error')
                    ->danger()
                    ->body($response->body())
                    ->send();
            }
        }
    }

    private function getPesaPalToken(): string
    {
        $response = Http::withoutVerifying()
            ->post('https://pay.pesapal.com/v3/api/Auth/RequestToken', [
                'consumer_key' => config('services.pesapal.consumer_key'),
                'consumer_secret' => config('services.pesapal.consumer_secret'),
            ]);

        return $response->json('token');
    }
}
