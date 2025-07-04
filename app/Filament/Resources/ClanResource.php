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

    protected static ?string $navigationGroup = 'Culture Preservation';

    public static function getNavigationBadge(): ?string
    {
        return Clan::count(); // Count all users
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Clan Identity')
                    ->description(fn() => $form->getOperation() !== 'view' ? 'Basic details about the clan and its totem.' : null)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Clan Name')
                            ->placeholder('e.g. Babiito, Baitira, Bagaiga')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Enter the full name of the clan.' : null)
                            ->required()
                            ->maxLength(191),

                        Forms\Components\TextInput::make('totem')
                            ->label('Totem')
                            ->placeholder('e.g. Leopard, Buffalo')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Animal or symbol associated with the clan.' : null)
                            ->maxLength(191),
                    ]),

                Forms\Components\Section::make('Clan Background')
                    ->description(fn() => $form->getOperation() !== 'view' ? 'Historical and traditional background of the clan.' : null)
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Enter a brief history or role of the clan in Tooro Kingdom.')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'This may include clan roles, customs, etc.' : null)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('origin')
                            ->label('Origin')
                            ->placeholder('Where did this clan come from? Mention places, migrations, etc.')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'You can describe migration stories or traditional roots.' : null)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Leadership & Notable Members')
                    ->description(fn() => $form->getOperation() !== 'view' ? 'Info about traditional leadership and clan members.' : null)
                    ->schema([
                        Forms\Components\TextInput::make('leader_title')
                            ->label('Leader Title')
                            ->placeholder('e.g. Omutaka, Omukulu')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'What title is given to the clan head?' : null)
                            ->maxLength(191),

                        Forms\Components\Textarea::make('notable_members')
                            ->label('Notable Members')
                            ->placeholder('List well-known historical or modern figures from this clan.')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Separate names with commas if listing multiple.' : null)
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
            ->striped()
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
