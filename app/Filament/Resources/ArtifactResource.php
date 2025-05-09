<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArtifactResource\Pages;
use App\Filament\Resources\ArtifactResource\RelationManagers;
use App\Models\Artifact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class ArtifactResource extends Resource
{
    protected static ?string $model = Artifact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Artifact Details')
                    ->description('Basic information describing the cultural artifact.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->placeholder('e.g. Engalabi Drum')
                            ->helperText('The traditional or known name of the artifact.')
                            ->required()
                            ->maxLength(191),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Provide a detailed explanation of what this artifact is.')
                            ->helperText('Include historical, spiritual, or functional background.')
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('material')
                            ->label('Material')
                            ->placeholder('e.g. Wood, Cowhide, Clay')
                            ->helperText('What is the artifact made of?')
                            ->maxLength(191),

                        Forms\Components\TextInput::make('origin')
                            ->label('Origin')
                            ->placeholder('e.g. Batooro Royal Court, 18th Century')
                            ->helperText('Where or when was this artifact first used or discovered?')
                            ->maxLength(191),
                    ]),

                Forms\Components\Section::make('Function & Categorization')
                    ->description('Understand the role and classification of the artifact.')
                    ->schema([
                        Forms\Components\Textarea::make('use_case')
                            ->label('Use Case')
                            ->placeholder('How is or was this artifact traditionally used?')
                            ->helperText('E.g. Ceremonial drum, cooking pot, leadership staff.')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('category')
                            ->label('Category')
                            ->placeholder('e.g. Musical Instrument, Tool, Ritual Item')
                            ->helperText('General classification of the artifact.')
                            ->maxLength(191),
                    ]),

                Forms\Components\Section::make('Preservation')
                    ->description('Details about current condition and location.')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->label('Artifact Image')
                            ->helperText('Upload a clear photo of the artifact.')
                            ->placeholder('Choose images to upload')
                            ->collection('artifact_images')
                            ->image()
                            ->required()
                            ->multiple()
                            ->responsiveImages()
                            ->conversion('thumb')
                            ->columnSpanFull()
                            ->columns(3),


                        Forms\Components\TextInput::make('preservation_status')
                            ->label('Preservation Status')
                            ->placeholder('e.g. Excellent, Damaged, Lost')
                            ->helperText('Describe the current physical condition.')
                            ->maxLength(191),

                        Forms\Components\TextInput::make('location')
                            ->label('Current Location')
                            ->placeholder('e.g. Tooro Kingdom Museum, Fort Portal')
                            ->helperText('Where can this artifact currently be found?')
                            ->maxLength(191),
                    ]),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Grid::make(3)->schema([
                    Split::make([
                        SpatieMediaLibraryImageColumn::make('image_path')
                            ->collection('artifact_images')
                            ->height(200)
                            ->width(200)
                            ->conversion('thumb') // optional
                            ->circular(),

                        TextColumn::make('name')->weight('bold'),
                        TextColumn::make('material'),
                        TextColumn::make('origin'),
                        TextColumn::make('category'),
                        TextColumn::make('preservation_status'),
                        TextColumn::make('location'),
                    ]),
                ]),
            ])
            ->filters([
                // Add filters if needed
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
            'index' => Pages\ListArtifacts::route('/'),
            'create' => Pages\CreateArtifact::route('/create'),
            'view' => Pages\ViewArtifact::route('/{record}'),
            'edit' => Pages\EditArtifact::route('/{record}/edit'),
        ];
    }
}
