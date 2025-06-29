<?php

namespace App\Filament\Pages;

use App\Models\AboutTooro;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Components\RichEditor;
use Filament\Notifications\Notification;

class AboutTooroPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.about-tooro';
    protected static ?string $navigationLabel = 'About Tooro Kingdom';
    protected static ?string $title = 'About Tooro Kingdom';
    protected static ?string $slug = 'about-tooro';

    public ?array $data = [];

    public function mount(): void
    {
        $about = AboutTooro::firstOrNew();
        $this->form->fill($about->toArray());
    }

    public function form(Form $form): Form
    {
        $isAdmin = auth()->user()->hasRole('admin');

        return $form
            ->schema([
                RichEditor::make('content')
                    ->label('Biography of Tooro Kingdom')
                    ->required()
                    ->columnSpanFull()
                    ->extraAttributes([
                        'style' => 'min-height: 80vh;',
                    ])->disabled(! $isAdmin)
                    ->toolbarButtons($isAdmin
                        ? [
                            'bold',
                            'italic',
                            'strike',
                            'underline',
                            'link',
                            'bulletList',
                            'orderedList',
                            'blockquote',
                            'h2',
                            'h3',
                            'codeBlock',
                            'undo',
                            'redo',
                        ]
                        : [])
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        if (!auth()->user()->hasRole('admin')) {
            return [];
        }

        return [
            Action::make('save')
                ->label('Save')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $about = AboutTooro::firstOrNew();
        $about->content = $data['content'];
        $about->save();

        Notification::make()
            ->title('Saved')
            ->body('Bio content saved successfully.')
            ->success()
            ->send();
    }
}
