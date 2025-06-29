<?php

namespace App\Filament\Resources\Torrent\AnnounceLogResource\Pages;

use App\Filament\Resources\Torrent\AnnounceLogResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnnounceLog extends EditRecord
{
    protected static string $resource = AnnounceLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
