<?php

namespace App\Filament\Resources\User\UserPasskeyResource\Pages;

use App\Filament\PageListSingle;
use App\Filament\Resources\User\UserPasskeyResource;

class ManageUserPasskey extends PageListSingle
{
    protected static string $resource = UserPasskeyResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
