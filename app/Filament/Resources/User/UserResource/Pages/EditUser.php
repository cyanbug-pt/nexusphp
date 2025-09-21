<?php

namespace App\Filament\Resources\User\UserResource\Pages;

use Filament\Actions\Contracts\HasActions;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\User\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord implements HasActions
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
