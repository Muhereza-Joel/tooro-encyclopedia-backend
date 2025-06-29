<?php

namespace App\Jobs;

use App\Models\Event;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class NotifyUsersOfNewEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Event $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function handle(): void
    {
        $users = User::where('id', '!=', auth()->id())->get();

        foreach ($users as $user) {
            Notification::make()
                ->title('New Event Published')
                ->body("A new event \"{$this->event->title}\" is now available. Click to view details.")
                ->actions([
                    Action::make('View Event')
                        ->url(route('filament.dashboard.resources.events.view', ['record' => $this->event->id]))
                ])
                ->sendToDatabase($user);
        }
    }
}
