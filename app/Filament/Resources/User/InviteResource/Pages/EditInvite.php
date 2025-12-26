<?php

namespace App\Filament\Resources\User\InviteResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\User\InviteResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInvite extends EditRecord
{
    protected static string $resource = InviteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
