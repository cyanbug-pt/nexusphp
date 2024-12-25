<?php

namespace App\Filament\Resources\User\UserMetaResource\Pages;

use App\Filament\Resources\User\UserMetaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserMeta extends EditRecord
{
    protected static string $resource = UserMetaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
