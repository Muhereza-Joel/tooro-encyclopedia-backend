<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PettyNameResource\Pages;
use App\Filament\Resources\PettyNameResource\RelationManagers;
use App\Models\PettyName;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PettyNameResource extends Resource
{
    protected static ?string $model = PettyName::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    public static function getNavigationBadge(): ?string
    {
        return PettyName::count(); // Count all users
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Petty Name Details')
                    ->description('Information about the petty name and its significance in Tooro culture.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Petty Name')
                            ->placeholder('e.g. Atwooki, Abwooli')
                            ->helperText('Enter the full petty name (Empaako).')
                            ->required()
                            ->maxLength(191),

                        Forms\Components\TextInput::make('gender')
                            ->label('Gender')
                            ->placeholder('e.g. Male, Female, Unisex')
                            ->helperText('Which gender commonly receives this petty name?')
                            ->required()
                            ->maxLength(191),

                        Forms\Components\Textarea::make('meaning')
                            ->label('Meaning')
                            ->placeholder('What does this name signify or symbolize?')
                            ->helperText('Describe the cultural or literal meaning of the name.')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Cultural Context')
                    ->description('Background information about the name’s use in society.')
                    ->schema([
                        Forms\Components\TextInput::make('origin')
                            ->label('Origin')
                            ->placeholder('e.g. From Batooro royal family, pastoral roots')
                            ->helperText('Describe the origin of this name if known.')
                            ->maxLength(191),

                        Forms\Components\Textarea::make('description')
                            ->label('Additional Notes')
                            ->placeholder('Any traditional stories, myths, or beliefs associated with the name.')
                            ->helperText('You can mention how it’s given or any taboos around it.')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('common_in_clans')
                            ->label('Common in Clans')
                            ->placeholder('e.g. Babiito, Bateizi')
                            ->helperText('Mention clans where this petty name is commonly used.')
                            ->maxLength(191),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),

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
            'index' => Pages\ListPettyNames::route('/'),
            'create' => Pages\CreatePettyName::route('/create'),
            'view' => Pages\ViewPettyName::route('/{record}'),
            'edit' => Pages\EditPettyName::route('/{record}/edit'),
        ];
    }
}
