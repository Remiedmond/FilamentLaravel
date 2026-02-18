<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // CHAMP AJOUTÉ ICI :
                Select::make('user_id')
                    ->label('Chef de Projet (Responsable)')
                    ->relationship('user', 'name') // Affiche le nom de l'utilisateur
                    ->searchable()
                    ->preload()
                    ->default(auth()->id())
                    ->disabled(! auth()->user()->isAdmin()) // Seul l'admin peut le modifier
                    ->visible(auth()->user()->isAdmin()), // Seul l'admin le voit

                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                DateTimePicker::make('date-start')
                    ->required(),
                DateTimePicker::make('date-end'),
                TextInput::make('location')
                    ->required(),
                FileUpload::make('cover_image')
                    ->disk('public')
                    ->directory('events')
                    ->image(),
                TextInput::make('max_participants')
                    ->numeric(),
                TextInput::make('max_guests_per_registration')
                    ->numeric(),
                Toggle::make('is_public')
                    ->required(),
            ]);
    }
}
