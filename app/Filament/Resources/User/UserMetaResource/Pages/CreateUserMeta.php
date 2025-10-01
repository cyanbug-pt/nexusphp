<?php

namespace App\Filament\Resources\User\UserMetaResource\Pages;

use Filament\Actions\Contracts\HasActions;
use App\Filament\Resources\User\UserMetaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserMeta extends CreateRecord implements HasActions
{
    protected static string $resource = UserMetaResource::class;
}
