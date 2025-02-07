<?php

namespace App\Filament\Resources\System\SeedBoxRecordResource\Pages;

use App\Filament\Resources\System\SeedBoxRecordResource;
use App\Repositories\SeedBoxRepository;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSeedBoxRecord extends EditRecord
{
    protected static string $resource = SeedBoxRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function save(bool $shouldRedirect = true, bool $shouldSendSavedNotification = true): void
    {
        $data = $this->form->getState();
        $rep = new SeedBoxRepository();
        try {
            $this->record = $rep->update($data, $this->record->id);
            send_admin_success_notification();
            $this->redirect($this->getResource()::getUrl('index'));
        } catch (\Exception $exception) {
            send_admin_fail_notification($exception->getMessage());
        }
    }
}
