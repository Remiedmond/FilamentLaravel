<?php

namespace App\Filament\Resources\Registrations\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Placeholder;

class RegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. Le titre de l'événement
               Placeholder::make('event_title')
                    ->label('Événement concerné')
                    ->content(fn ($record): string => $record->event?->title ?? 'Événement inconnu'),

                TextInput::make('name')
                    ->label('Nom de l\'inscrit')
                    ->disabled(),

                TextInput::make('email')
                    ->label('Email')
                    ->disabled(),

                    Textarea::make('allergies')
                            ->label('Allergies')
                            ->columnSpanFull(),

                // 3. Le Repeater (rattaché directement aux components)
                Repeater::make('guests_details')
                    ->label('Accompagnateurs & Allergies')
                    ->schema([
                        TextInput::make('firstname')->label('Prénom'),
                        TextInput::make('lastname')->label('Nom'),
                        Textarea::make('allergies')
                            ->label('Allergies')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
