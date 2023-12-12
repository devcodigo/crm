<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Mail\TeamInvitationMail;
use App\Models\Invitation;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Mail;
use Symfony\Contracts\Service\Attribute\Required;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('inviteUser')
                ->form([
                TextInput::make('email')
                    ->email()
                    ->required()
            ])
                ->action(function($data) {
                    $invitation = Invitation::create(['email'=> $data['email']]);

                Mail::to($invitation->email)->send(new TeamInvitationMail($invitation));

                Notification::make('invitedSucces')
                ->body('User invited succesfuly')
                ->success()->send();

                }),
        ];
    }
}
