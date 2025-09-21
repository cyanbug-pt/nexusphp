<?php

namespace App\Filament\Resources\Oauth\ProviderResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\PageListSingle;
use App\Filament\Resources\Oauth\ProviderResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageProviders extends PageListSingle
{
    protected static string $resource = ProviderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
