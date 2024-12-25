<?php

namespace App\Filament\Resources\User\UserMedalResource\Pages;

use App\Filament\Resources\User\UserMedalResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserMedal extends EditRecord
{
    protected static string $resource = UserMedalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
