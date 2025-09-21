<?php

namespace App\Filament\Resources\User\HitAndRunResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\User\HitAndRunResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHitAndRun extends EditRecord
{
    protected static string $resource = HitAndRunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
