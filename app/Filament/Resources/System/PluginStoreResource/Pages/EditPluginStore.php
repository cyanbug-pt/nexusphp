<?php

namespace App\Filament\Resources\System\PluginStoreResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\System\PluginStoreResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPluginStore extends EditRecord
{
    protected static string $resource = PluginStoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
