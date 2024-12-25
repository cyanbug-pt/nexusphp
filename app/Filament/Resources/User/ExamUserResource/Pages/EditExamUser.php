<?php

namespace App\Filament\Resources\User\ExamUserResource\Pages;

use App\Filament\Resources\User\ExamUserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExamUser extends EditRecord
{
    protected static string $resource = ExamUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
