<?php

namespace App\Filament\Resources\User\UserResource\Pages;

use Filament\Actions\Contracts\HasActions;
use App\Filament\Resources\User\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord implements HasActions
{
    protected static string $resource = UserResource::class;
}
