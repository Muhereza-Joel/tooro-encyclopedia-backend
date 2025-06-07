<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Forms;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Authenticatable;

class Register extends BaseRegister
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form($this->makeForm())
                ->schema([
                    $this->getNameFormComponent(),
                    $this->getEmailFormComponent(),
                    $this->getPasswordFormComponent(),
                    $this->getPasswordConfirmationFormComponent(),
                    Forms\Components\Radio::make('role')
                        ->label('Registering as')
                        ->options([
                            'Youth' => 'Youth',

                        ])
                        ->required(),
                ])
                ->statePath('data'),
        ];
    }

    protected function handleRegistration(array $data): \Illuminate\Database\Eloquent\Model
    {
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => $data['password'],
        ]);

        // Assign role
        $user->assignRole($data['role']);

        return $user;
    }
}
