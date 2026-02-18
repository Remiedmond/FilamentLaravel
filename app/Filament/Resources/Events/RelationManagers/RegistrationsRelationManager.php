<?php

namespace App\Filament\Resources\Events\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class RegistrationsRelationManager extends RelationManager
{
    protected static string $relationship = 'registrations';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('name')
                    ->label('Nom complet')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('additional_guests')
                    ->label('Accompagnants')
                    ->numeric()
                    ->default(0),
                Forms\Components\Textarea::make('allergies')
                    ->label('Allergies/Régime')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            // AJOUT ICI : On utilise la description du tableau pour mettre notre lien
            ->description(fn ($livewire) => new HtmlString('
                <a href="' . route('events.export', $livewire->ownerRecord) . '"
                   style="background-color: #22c55e; color: white; padding: 8px 16px; border-radius: 8px; font-weight: bold; text-decoration: none; display: inline-block; margin-bottom: 10px;">
                   📥 Exporter la liste (CSV)
                </a>
            '))
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nom'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('additional_guests')->label('Acc.'),
                Tables\Columns\TextColumn::make('allergies')->label('Allergies')->limit(20),
            ])
            ->headerActions([]) // On laisse vide pour éviter les erreurs de classe
            ->actions([])
            ->bulkActions([]);
    }
}
