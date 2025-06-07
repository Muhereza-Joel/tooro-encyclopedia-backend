<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(191),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('location')
                    ->maxLength(191),
                Forms\Components\DateTimePicker::make('start_time')
                    ->required(),
                Forms\Components\DateTimePicker::make('end_time')
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0.00)
                    ->prefix('$'),
                Forms\Components\TextInput::make('capacity')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->money('Ugx')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->iconButton(),
                Tables\Actions\EditAction::make()
                    ->iconButton(),
                Action::make('book')
                    ->label('Book Now')
                    ->button()
                    ->size('sm')
                    ->outlined()
                    ->form([
                        Forms\Components\TextInput::make('quantity')
                            ->label('Number of Tickets')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(fn(Event $record) => $record->capacity),
                    ])
                    ->action(function (Event $record, array $data) {
                        $user = auth()->user();

                        if ($data['quantity'] > $record->capacity) {
                            Notification::make()
                                ->title('Booking Failed')
                                ->danger()
                                ->body('Not enough available seats')
                                ->send();
                            return;
                        }

                        $booking = $user->bookings()->create([
                            'event_id' => $record->id,
                            'quantity' => $data['quantity'],
                            'status' => 'pending',
                        ]);

                        Notification::make()
                            ->title('Booking Successful')
                            ->success()
                            ->body("You've booked {$data['quantity']} ticket(s) for {$record->title}")
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Confirm Booking')
                    ->modalDescription('Are you sure you want to book this event?')
                    ->modalSubmitActionLabel('Yes, book now'),
            ]);
    }



    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'view' => Pages\ViewEvent::route('/{record}'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
