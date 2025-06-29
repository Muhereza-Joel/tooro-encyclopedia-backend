<?php

namespace App\Filament\Resources\QuestionResource\Pages;

use App\Filament\Resources\QuestionResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;

class ListQuestions extends ListRecords
{
    protected static string $resource = QuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),

            'last_24_hours' => Tab::make('Last 24 Hours')
                ->modifyQueryUsing(
                    fn($query) =>
                    $query->where('created_at', '>=', Carbon::now()->subDay())
                ),

            'last_3_days' => Tab::make('Last 3 Days')
                ->modifyQueryUsing(
                    fn($query) =>
                    $query->where('created_at', '>=', Carbon::now()->subDays(3))
                ),

            'last_week' => Tab::make('Last Week')
                ->modifyQueryUsing(
                    fn($query) =>
                    $query->where('created_at', '>=', Carbon::now()->subDays(7))
                ),
        ];
    }
}
