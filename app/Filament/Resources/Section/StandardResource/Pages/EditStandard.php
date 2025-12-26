<?php

namespace App\Filament\Resources\Section\StandardResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\Section\StandardResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Section\CodecResource\Pages\EditCodec;

class EditStandard extends EditCodec
{
    protected static string $resource = StandardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
