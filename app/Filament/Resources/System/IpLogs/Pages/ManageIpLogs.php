<?php

namespace App\Filament\Resources\System\IpLogs\Pages;

use App\Filament\PageListSingle;
use App\Filament\Resources\System\IpLogs\IpLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageIpLogs extends PageListSingle
{
    protected static string $resource = IpLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            CreateAction::make(),
        ];
    }
}
