<?php

namespace App\Jobs;

use App\Models\Question;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Filament\Notifications\Notification;

class NotifyUsersOfNewQuestion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Question $question;

    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    public function handle(): void
    {
        $users = User::where('id', '!=', $this->question->user_id)->get();

        foreach ($users as $user) {
            Notification::make()
                ->title('New Question Asked')
                ->body("{$this->question->user->name} asked: \"{$this->question->title}\"")
                ->actions([
                    \Filament\Notifications\Actions\Action::make('View')
                        ->url(route('filament.dashboard.resources.questions.view', ['record' => $this->question->id]))
                ])
                ->sendToDatabase($user);
        }
    }
}
