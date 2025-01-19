<?php

namespace App\Filament\Resources\System\PluginStoreResource\Pages;

use App\Filament\Resources\System\PluginStoreResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPluginStores extends ListRecords
{
    protected static string $resource = PluginStoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }
}
