<?php

namespace App\Filament\Resources\Registrations\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class RegistrationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('event.title')
                    ->label('Événement')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Inscrit')
                    ->searchable(),
               TextColumn::make('guests_count')
                    ->label('Accompagnateurs')
                    ->getStateUsing(function ($record) {
                        $state = $record->guests_details;

                        if (!is_array($state) || empty($state)) {
                            return 0;
                        }

                        return collect($state)
                            ->filter(fn ($guest) => !empty($guest['firstname']) || !empty($guest['lastname']))
                            ->count();
                    })
                    ->badge()
                    ->color('info'),
                TextColumn::make('created_at')
                            ->label('Date')
                            ->dateTime('d/m/Y H:i'),
                    ]);
    }
}
