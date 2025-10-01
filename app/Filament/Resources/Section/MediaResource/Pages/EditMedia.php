<?php

namespace App\Filament\Resources\Section\MediaResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\Section\MediaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Section\CodecResource\Pages\EditCodec;

class EditMedia extends EditCodec
{
    protected static string $resource = MediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
