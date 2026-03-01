<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Models\Feedback;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms;
use Filament\Actions\Action;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationLabel = 'Avis & Feedbacks';

    protected static ?string $modelLabel = 'Feedback';

    protected static ?string $pluralModelLabel = 'Feedbacks';

    /**
     * Configuration du groupe avec compatibilité PHP 8.3
     */
    protected static string|\UnitEnum|null $navigationGroup = 'Gestion Événements';

    /**
     * Formulaire de consultation
     */
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\Section::make('Détails de l\'avis')
                    ->description('Vue détaillée du retour envoyé par le participant.')
                    ->schema([
                        Forms\Components\Select::make('event_id')
                            ->relationship('event', 'title')
                            ->disabled()
                            ->label('Événement'),
                        Forms\Components\Select::make('registration_id')
                            ->relationship('registration', 'name')
                            ->disabled()
                            ->label('Participant'),
                        Forms\Components\TextInput::make('rating')
                            ->numeric()
                            ->disabled()
                            ->label('Note / 5'),
                        Forms\Components\Textarea::make('comment')
                            ->disabled()
                            ->label('Commentaire')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('event.title')
                    ->label('Événement')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('registration.name')
                    ->label('Participant')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('rating')
                    ->label('Note')
                    ->badge()
                    ->color(fn (int $state): string => match (true) {
                        $state >= 4 => 'success',
                        $state === 3 => 'warning',
                        default => 'danger',
                    })
                    ->formatStateUsing(fn ($state) => "{$state} / 5")
                    ->sortable(),

                TextColumn::make('comment')
                    ->label('Commentaire')
                    ->limit(50),

                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('event')
                    ->relationship('event', 'title')
                    ->label('Par événement'),
            ])
            ->actions([
                // On utilise l'action de base importée depuis Filament\Actions\Action
                Action::make('view')
                    ->label('Voir')
                    ->icon('heroicon-m-eye')
                    ->color('gray')
                    ->form(fn (Feedback $record) => [
                        Forms\Components\TextInput::make('rating_display')
                            ->label('Note')
                            ->default($record->rating . ' / 5')
                            ->disabled(),
                        Forms\Components\Textarea::make('comment_display')
                            ->label('Commentaire')
                            ->default($record->comment)
                            ->disabled(),
                    ])
                    ->modalSubmitAction(false),

                Action::make('delete')
                    ->label('Supprimer')
                    ->icon('heroicon-m-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn (Feedback $record) => $record->delete()),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeedback::route('/'),
        ];
    }
}
