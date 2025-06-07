<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClanResource\Pages;
use App\Filament\Resources\ClanResource\RelationManagers;
use App\Models\Clan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClanResource extends Resource
{
    protected static ?string $model = Clan::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Clan Identity')
                    ->description('Basic details about the clan and its totem.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Clan Name')
                            ->placeholder('e.g. Babiito, Baitira, Bagaiga')
                            ->helperText('Enter the full name of the clan.')
                            ->required()
                            ->maxLength(191),

                        Forms\Components\TextInput::make('totem')
                            ->label('Totem')
                            ->placeholder('e.g. Leopard, Buffalo')
                            ->helperText('Animal or symbol associated with the clan.')
                            ->maxLength(191),
                    ]),

                Forms\Components\Section::make('Clan Background')
                    ->description('Historical and traditional background of the clan.')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Enter a brief history or role of the clan in Tooro Kingdom.')
                            ->helperText('This may include clan roles, customs, etc.')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('origin')
                            ->label('Origin')
                            ->placeholder('Where did this clan come from? Mention places, migrations, etc.')
                            ->helperText('You can describe migration stories or traditional roots.')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Leadership & Notable Members')
                    ->description('Info about traditional leadership and clan members.')
                    ->schema([
                        Forms\Components\TextInput::make('leader_title')
                            ->label('Leader Title')
                            ->placeholder('e.g. Omutaka, Omukulu')
                            ->helperText('What title is given to the clan head?')
                            ->maxLength(191),

                        Forms\Components\Textarea::make('notable_members')
                            ->label('Notable Members')
                            ->placeholder('List well-known historical or modern figures from this clan.')
                            ->helperText('Separate names with commas if listing multiple.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('totem')
                    ->searchable(),
                Tables\Columns\TextColumn::make('leader_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListClans::route('/'),
            'create' => Pages\CreateClan::route('/create'),
            'view' => Pages\ViewClan::route('/{record}'),
            'edit' => Pages\EditClan::route('/{record}/edit'),
        ];
    }
}
