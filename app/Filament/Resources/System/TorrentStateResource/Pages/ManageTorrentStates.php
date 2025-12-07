<?php

namespace App\Filament\Resources\System\TorrentStateResource\Pages;

use App\Filament\Resources\System\TorrentStateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageTorrentStates extends ManageRecords
{
    protected static string $resource = TorrentStateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

}
