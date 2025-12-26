<?php

namespace App\Filament\Resources\Torrent\TorrentResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\Torrent\TorrentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTorrent extends EditRecord
{
    protected static string $resource = TorrentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
