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
                    ->description('Basic information about the article')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Article Title')
                            ->placeholder('Enter the title of the article')
                            ->helperText('Keep it short and descriptive')
                            ->required()
                            ->maxLength(191),

                        Forms\Components\Select::make('category_id')
                            ->label('Category')
                            ->placeholder('Select a category')
                            ->helperText('Choose the most appropriate category')
                            ->relationship('category', 'name')
                            ->required(),

                        Forms\Components\Select::make('author_id')
                            ->label('Author')
                            ->placeholder('Select an author')
                            ->helperText('Assign an author to this article')
                            ->relationship('author', 'name')
                            ->required(),

                        Forms\Components\DatePicker::make('published_at')
                            ->label('Publication Date')
                            ->placeholder('Choose publish date')
                            ->helperText('Select when this article should go live')
                            ->native(false),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Feature this Article?')
                            ->helperText('Featured articles appear prominently')
                            ->required(),
                    ]),

                Forms\Components\Section::make('Article Summary')
                    ->description('Short summary that introduces the article')
                    ->schema([
                        Forms\Components\RichEditor::make('summary')
                            ->label('Summary')
                            ->placeholder('Write a brief summary of the article')
                            ->helperText('Used as a preview or excerpt')
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
                    ->description('Main body of the article')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label('Content')
                            ->placeholder('Write the full article content')
                            ->helperText('This will be the main body of the article')
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
                    ->description('Upload related images for the article')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Article Images')
                            ->helperText('Upload clear, relevant images')
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
