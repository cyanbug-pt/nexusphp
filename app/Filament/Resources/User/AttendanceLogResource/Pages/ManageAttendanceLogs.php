<?php

namespace App\Filament\Resources\User\AttendanceLogResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\PageListSingle;
use App\Filament\Resources\User\AttendanceLogResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAttendanceLogs extends PageListSingle
{
    protected static string $resource = AttendanceLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
