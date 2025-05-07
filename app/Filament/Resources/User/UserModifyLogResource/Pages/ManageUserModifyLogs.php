<?php

namespace App\Filament\Resources\User\UserModifyLogResource\Pages;

use App\Filament\PageListSingle;
use App\Filament\Resources\User\UserModifyLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageUserModifyLogs extends PageListSingle
{
    protected static string $resource = UserModifyLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
