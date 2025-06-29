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
                    ->description(fn() => $form->getOperation() !== 'view' ? 'Information about the petty name and its significance in Tooro culture.' : null)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Petty Name')
                            ->placeholder('e.g. Atwooki, Abwooli')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Enter the full petty name (Empaako).' : null)
                            ->required()
                            ->maxLength(191),

                        Forms\Components\TextInput::make('gender')
                            ->label('Gender')
                            ->placeholder('e.g. Male, Female, Unisex')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Which gender commonly receives this petty name?' : null)
                            ->required()
                            ->maxLength(191),

                        Forms\Components\Textarea::make('meaning')
                            ->label('Meaning')
                            ->placeholder('What does this name signify or symbolize?')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Describe the cultural or literal meaning of the name.' : null)
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Cultural Context')
                    ->description(fn() => $form->getOperation() !== 'view' ? 'Background information about the name’s use in society.' : null)
                    ->schema([
                        Forms\Components\TextInput::make('origin')
                            ->label('Origin')
                            ->placeholder('e.g. From Batooro royal family, pastoral roots')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Describe the origin of this name if known.' : null)
                            ->maxLength(191),

                        Forms\Components\Textarea::make('description')
                            ->label('Additional Notes')
                            ->placeholder('Any traditional stories, myths, or beliefs associated with the name.')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'You can mention how it’s given or any taboos around it.' : null)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('common_in_clans')
                            ->label('Common in Clans')
                            ->placeholder('e.g. Babiito, Bateizi')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Mention clans where this petty name is commonly used.' : null)
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
