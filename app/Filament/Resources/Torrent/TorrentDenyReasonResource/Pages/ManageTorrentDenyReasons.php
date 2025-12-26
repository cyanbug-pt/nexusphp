<?php

namespace App\Filament\Resources\Torrent\TorrentDenyReasonResource\Pages;

use Filament\Support\Enums\Width;
use Filament\Actions\CreateAction;
use App\Filament\Resources\Torrent\TorrentDenyReasonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTorrentDenyReasons extends ManageRecords
{
    protected Width|string|null $maxContentWidth = 'full';

    protected static string $resource = TorrentDenyReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
