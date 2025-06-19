<?php

namespace App\Filament\Resources\System\MessageTemplateResource\Pages;

use App\Filament\PageListSingle;
use App\Filament\Resources\System\MessageTemplateResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMessageTemplates extends PageListSingle
{
    protected static string $resource = MessageTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
