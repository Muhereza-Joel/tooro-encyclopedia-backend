<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Category Information')
                    ->description(fn() => $form->getOperation() !== 'view' ? 'Define the details of the category for organization and filtering.' : null)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Category Name')
                            ->placeholder('e.g., "Cultural Events", "Artifacts", "Proverbs"')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'This name will be used for display and filtering.' : null)
                            ->required()
                            ->maxLength(191),

                        Forms\Components\RichEditor::make('description')
                            ->label('Category Description')
                            ->placeholder('Describe what this category is about...')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Provide more information about the purpose or use of this category.' : null)
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'link',
                                'bulletList',
                                'orderedList',
                                'h2',
                                'h3',
                                'blockquote',
                                'redo',
                                'undo',
                            ])
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('icon')
                            ->label('Icon (optional)')
                            ->placeholder('e.g., "heroicon-o-archive", "fa-solid fa-landmark"')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Provide the name of a valid icon if you wish to visually represent this category.' : null)
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
                Tables\Columns\TextColumn::make('slug')
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'view' => Pages\ViewCategory::route('/{record}'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
