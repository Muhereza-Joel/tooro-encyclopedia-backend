<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Question;
use App\Observers\EventObserver;
use App\Observers\QuestionObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Question::observe(QuestionObserver::class);
        Event::observe(EventObserver::class);
    }
}
