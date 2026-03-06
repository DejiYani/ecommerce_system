<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
         
                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->required(),
                Select::make('role')
                    ->options(['Admin' => 'Admin', 'Cashier' => 'Cashier'])
                    ->required(),
                
            ])->columns(1);
    }
}
