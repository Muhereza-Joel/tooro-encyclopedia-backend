<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getNavigationBadge(): ?string
    {
        return Article::count(); // Count all users
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Article Info')
                    ->description(fn() => $form->getOperation() !== 'view' ? 'Basic information about the article' : null)
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Article Title')
                            ->placeholder('Enter the title of the article')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Keep it short and descriptive' : null)
                            ->required()
                            ->maxLength(191),

                        Forms\Components\Select::make('category_id')
                            ->label('Category')
                            ->placeholder('Select a category')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Choose the most appropriate category' : null)
                            ->relationship('category', 'name')
                            ->required(),

                        Forms\Components\Select::make('author_id')
                            ->label('Author')
                            ->placeholder('Select an author')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Assign an author to this article' : null)
                            ->relationship('author', 'name')
                            ->required(),

                        Forms\Components\DatePicker::make('published_at')
                            ->label('Publication Date')
                            ->placeholder('Choose publish date')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Select when this article should go live' : null)
                            ->native(false),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Feature this Article?')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Featured articles appear prominently' : null)
                            ->required(),
                    ]),

                Forms\Components\Section::make('Article Summary')
                    ->description(fn() => $form->getOperation() !== 'view' ? 'Short summary that introduces the article' : null)
                    ->schema([
                        Forms\Components\RichEditor::make('summary')
                            ->label('Summary')
                            ->placeholder('Write a brief summary of the article')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Used as a preview or excerpt' : null)
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
                    ]),

                Forms\Components\Section::make('Full Content')
                    ->description(fn() => $form->getOperation() !== 'view' ? 'Main body of the article' : null)
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label('Content')
                            ->placeholder('Write the full article content')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'This will be the main body of the article' : null)
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
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Images')
                    ->description(fn() => $form->getOperation() !== 'view' ? 'Upload related images for the article' : null)
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Article Images')
                            ->helperText(fn() => $form->getOperation() !== 'view' ? 'Upload clear, relevant images' : null)
                            ->placeholder('Choose images to upload')
                            ->collection('article_images')
                            ->image()
                            ->required()
                            ->multiple()
                            ->responsiveImages()
                            ->conversion('thumb')
                            ->columnSpanFull()
                            ->columns(3),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
