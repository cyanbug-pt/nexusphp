<?php

namespace App\Filament\Resources\Section\ProcessingResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\Section\ProcessingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Section\CodecResource\Pages\EditCodec;

class EditProcessing extends EditCodec
{
    protected static string $resource = ProcessingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
