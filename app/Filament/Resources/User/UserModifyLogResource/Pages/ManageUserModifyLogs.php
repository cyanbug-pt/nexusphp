<?php

namespace App\Filament\Resources\User\UserModifyLogResource\Pages;

use Filament\Actions\Contracts\HasActions;
use App\Filament\PageListSingle;
use App\Filament\Resources\User\UserModifyLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageUserModifyLogs extends PageListSingle implements HasActions
{
    protected static string $resource = UserModifyLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
