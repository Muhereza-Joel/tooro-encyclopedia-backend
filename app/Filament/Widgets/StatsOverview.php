<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use App\Models\Artifact;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Clan;
use App\Models\Event;
use App\Models\PettyName;
use App\Models\Proverb;
use App\Models\Taboo;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Articles', Article::count())
                ->description('Total Articles')
                ->icon('heroicon-o-document-text')
                ->color('success')
                ->url('/dashboard/articles'),

            Stat::make('Artifacts', Artifact::count())
                ->description('Total Artifacts')
                ->icon('heroicon-o-cube')
                ->url('/dashboard/artifacts'),

            Stat::make('Bookings', Booking::count())
                ->description('Total Bookings')
                ->icon('heroicon-o-calendar-days')
                ->url('/dashboard/bookings'),

            Stat::make('Categories', Category::count())
                ->description('Total Categories')
                ->icon('heroicon-o-tag')
                ->url('/dashboard/categories'),

            Stat::make('Clans', Clan::count())
                ->description('Total Clans')
                ->icon('heroicon-o-users')
                ->url('/dashboard/clans'),

            Stat::make('Events', Event::count())
                ->description('Total Events')
                ->icon('heroicon-o-calendar')
                ->url('/dashboard/events'),

            Stat::make('Petty Names', PettyName::count())
                ->description('Total Petty Names')
                ->icon('heroicon-o-identification')
                ->url('/dashboard/petty-names'),

            Stat::make('Proverbs', Proverb::count())
                ->description('Total Proverbs')
                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->url('/dashboard/proverbs'),

            Stat::make('Taboos', Taboo::count())
                ->description('Total Taboos')
                ->icon('heroicon-o-exclamation-circle')
                ->url('/dashboard/taboos'),

            Stat::make('Transactions', Transaction::count())
                ->description('Total Transactions')
                ->icon('heroicon-o-currency-dollar')
                ->url('/dashboard/transactions'),
        ];
    }
}
