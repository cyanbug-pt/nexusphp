<?php

namespace App\Filament\Resources\User\ExamUserResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\User\ExamUserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExamUser extends EditRecord
{
    protected static string $resource = ExamUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
