<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TabooResource\Pages;
use App\Filament\Resources\TabooResource\RelationManagers;
use App\Models\Taboo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TabooResource extends Resource
{
    protected static ?string $model = Taboo::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';

    public static function getNavigationBadge(): ?string
    {
        return Taboo::count(); // Count all users
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Taboo Information')
                    ->description(fn() => $form->getOperation() !== 'view' ? 'Basic identification and context of the cultural taboo.' : null)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->placeholder('e.g. Do not eat fish during mourning')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'A short, descriptive title for the taboo.' : null)
                            ->required()
                            ->maxLength(191),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Describe the nature of this taboo in detail.')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Explain what the taboo is and how it is practiced.' : null)
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('reason')
                            ->label('Reason')
                            ->placeholder('Explain the traditional or spiritual justification for this taboo.')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Why is this taboo observed?' : null)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('consequence')
                            ->label('Consequence')
                            ->placeholder('What happens when the taboo is broken?')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Include myths, punishments, or cultural beliefs.' : null)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Applicability')
                    ->description(fn() => $form->getOperation() !== 'view' ? 'Specify who the taboo applies to and its cultural category.' : null)
                    ->schema([
                        Forms\Components\TextInput::make('applies_to')
                            ->label('Applies To')
                            ->placeholder('e.g. Pregnant women, royal clan members')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Indicate the individuals or groups affected by this taboo.' : null)
                            ->maxLength(191),


                        Forms\Components\TextInput::make('category')
                            ->label('Category')
                            ->placeholder('e.g. Food, Behavior, Ceremonial')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'General type or domain of this taboo.' : null)
                            ->maxLength(191),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('applies_to')
                    ->searchable(),
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
            'index' => Pages\ListTaboos::route('/'),
            'create' => Pages\CreateTaboo::route('/create'),
            'view' => Pages\ViewTaboo::route('/{record}'),
            'edit' => Pages\EditTaboo::route('/{record}/edit'),
        ];
    }
}
