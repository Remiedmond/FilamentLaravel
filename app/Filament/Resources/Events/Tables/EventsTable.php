<?php

namespace App\Filament\Resources\Events\Tables;

use App\Models\Event;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;


class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Lieu'),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_public')
                    ->label('Public')
                    ->boolean(),
                TextColumn::make('user.name')
                ->label('Chef de Projet')
                ->sortable()
                ->visible(fn () => auth()->user()->isAdmin()),
            ])
            ->actions([
                // On vide les actions pour éviter l'erreur de classe introuvable
            ])
            ->bulkActions([
                // On vide également les actions groupées
            ]);
    }
}
