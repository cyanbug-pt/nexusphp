<?php

namespace App\Filament\Resources\System\TrackerUrlResource\Pages;

use App\Filament\PageListSingle;
use App\Filament\Resources\System\TrackerUrlResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTrackerUrls extends PageListSingle
{
    protected static string $resource = TrackerUrlResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
