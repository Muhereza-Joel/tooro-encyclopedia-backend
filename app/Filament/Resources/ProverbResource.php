<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProverbResource\Pages;
use App\Filament\Resources\ProverbResource\RelationManagers;
use App\Models\Proverb;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProverbResource extends Resource
{
    protected static ?string $model = Proverb::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public static function getNavigationBadge(): ?string
    {
        return Proverb::count(); // Count all users
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Proverb Details')
                    ->description(fn() => $form->getOperation() !== 'view' ? 'Enter the main details of the proverb' : null)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Proverb')
                            ->placeholder('e.g., "Wisdom is like a baobab tree..."')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Enter the full text of the proverb' : null)
                            ->required()
                            ->maxLength(191),

                        Forms\Components\Textarea::make('meaning')
                            ->label('Meaning')
                            ->placeholder('Describe what the proverb means')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Give an explanation or interpretation' : null)
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Cultural Context')
                    ->description(fn() => $form->getOperation() !== 'view' ? 'Identify the origin and category of the proverb' : null)
                    ->schema([
                        Forms\Components\Select::make('origin')
                            ->label('Cultural Origin')
                            ->placeholder('Select the cultural group')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Where this proverb originates from' : null)
                            ->options([
                                'Yoruba' => 'Yoruba',
                                'Igbo' => 'Igbo',
                                'Hausa' => 'Hausa',
                                'Akan' => 'Akan',
                                'Swahili' => 'Swahili',
                                'Other' => 'Other',
                            ]),

                        Forms\Components\Select::make('category')
                            ->label('Proverb Category')
                            ->placeholder('Select a thematic category')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'What theme this proverb relates to' : null)
                            ->options([
                                'Wisdom' => 'Wisdom',
                                'Life' => 'Life',
                                'Community' => 'Community',
                                'Family' => 'Family',
                                'Work' => 'Work',
                                'Nature' => 'Nature',
                            ]),
                    ]),

                Forms\Components\Section::make('Usage')
                    ->description(fn() => $form->getOperation() !== 'view' ? 'Give an example of how this proverb is used' : null)
                    ->schema([
                        Forms\Components\TextInput::make('usageExamples')
                            ->label('Usage Example')
                            ->placeholder('e.g., "When elders are talking, you keep quiet."')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Optional: Show how the proverb is used in a sentence' : null),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('origin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
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
            'index' => Pages\ListProverbs::route('/'),
            'create' => Pages\CreateProverb::route('/create'),
            'view' => Pages\ViewProverb::route('/{record}'),
            'edit' => Pages\EditProverb::route('/{record}/edit'),
        ];
    }
}
