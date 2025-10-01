<?php

namespace App\Filament\Resources\System\ExamResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\PageList;
use App\Filament\Resources\System\ExamResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExams extends PageList
{
    protected static string $resource = ExamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
