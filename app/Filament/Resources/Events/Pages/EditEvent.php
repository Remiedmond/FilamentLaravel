<?php

namespace App\Filament\Resources\Events\Pages;

use App\Filament\Resources\Events\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventInvitationMail;

class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;

    /**
     * Définit les actions visibles en haut de la page d'édition.
     */
    protected function getHeaderActions(): array
    {
        return [
            // Bouton Inviter
            Actions\Action::make('invite')
                ->label('Inviter des personnes')
                ->icon('heroicon-o-envelope')
                ->color('success')
                // On ne l'affiche que si l'événement est privé
                ->visible(fn () => !$this->record->is_public)
                ->form([
                    Textarea::make('emails')
                        ->label('Adresses emails')
                        ->placeholder('jean@exemple.com, marie@exemple.com')
                        ->helperText('Séparez les emails par une virgule.')
                        ->required(),
                ])
                ->action(function (array $data) {
                    // $this->record contient l'événement actuel
                    $emails = preg_split('/[\s,]+/', $data['emails']);

                    foreach ($emails as $email) {
                        $email = trim($email);
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            Mail::to($email)->send(new EventInvitationMail($this->record));
                        }
                    }

                    Notification::make()
                        ->title('Invitations envoyées')
                        ->success()
                        ->send();
                }),

            // Action de suppression par défaut
            Actions\DeleteAction::make(),
        ];
    }
}
