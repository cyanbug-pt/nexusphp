<?php

namespace App\Filament\Resources\System\ActivityLogs\Pages;

use App\Filament\PageListSingle;
use App\Filament\Resources\System\ActivityLogs\ActivityLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageActivityLogs extends PageListSingle
{
    protected static string $resource = ActivityLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
