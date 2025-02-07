<?php

namespace App\Filament\Resources\System\ExamResource\Pages;

use App\Filament\Resources\System\ExamResource;
use App\Repositories\ExamRepository;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExam extends EditRecord
{
    protected static string $resource = ExamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function save(bool $shouldRedirect = true, bool $shouldSendSavedNotification = true): void
    {
        $data = $this->form->getState();
        $examRep = new ExamRepository();
        try {
            $this->record = $examRep->update($data, $this->record->id);
            send_admin_success_notification();
            $this->redirect($this->getResource()::getUrl('index'));
        } catch (\Exception $exception) {
            send_admin_fail_notification($exception->getMessage());
        }
    }
}
