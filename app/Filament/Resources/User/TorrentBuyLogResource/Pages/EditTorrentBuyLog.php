<?php

namespace App\Filament\Resources\User\TorrentBuyLogResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\User\TorrentBuyLogResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTorrentBuyLog extends EditRecord
{
    protected static string $resource = TorrentBuyLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
