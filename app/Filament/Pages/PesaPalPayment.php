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
        $ipnId = $this->registerIpnUrl();

        if ($this->bookingId) {
            $booking = Booking::findOrFail($this->bookingId);

            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->getPesaPalToken(),
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                ->post('https://cybqa.pesapal.com/pesapalv3/api/Transactions/SubmitOrderRequest', [
                    'id' => $booking->reference_number, // Unique reference number for the booking
                    'currency' => 'UGX',
                    // 'amount' => $booking->quantity * $booking->event->price,
                    'amount' => 500, // Assuming price is per booking
                    'description' => "Payment for {$booking->event->title} booking",
                    'callback_url' => route('pesapal.callback'),
                    'notification_id' => $ipnId,
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
            ->post('https://cybqa.pesapal.com/pesapalv3/api/Auth/RequestToken', [
                'consumer_key' => config('services.pesapal.consumer_key'),
                'consumer_secret' => config('services.pesapal.consumer_secret'),
            ]);

        return $response->json('token');
    }

    private function registerIpnUrl(): ?string
    {
        $response = Http::withoutVerifying()
            ->withHeaders([
                'Authorization' => 'Bearer ' . $this->getPesaPalToken(),
                'Content-Type' => 'application/json',
            ])

            // https://cybqa.pesapal.com/pesapalv3/api/Auth/RequestToken
            ->post('https://cybqa.pesapal.com/pesapalv3/api/URLSetup/RegisterIPN', [
                'url' => config('services.pesapal.ipn_url'), // You can set this in .env
                'ipn_notification_type' => 'GET', // or 'POST' depending on your setup
            ]);

        if ($response->successful()) {
            return $response->json('ipn_id'); // or check the correct key if it's different
        }

        Notification::make()
            ->title('PesaPal IPN Registration Failed')
            ->danger()
            ->body($response->body())
            ->send();

        return null;
    }
}
