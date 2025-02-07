<?php

namespace App\Filament\Resources\User\UserResource\Pages;

use App\Filament\Resources\User\UserResource;
use App\Repositories\UserRepository;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public function create(bool $another = false): void
    {
        $userRep = new UserRepository();
        $data = $this->form->getState();
        try {
            $this->record = $userRep->store($data);
            send_admin_success_notification();
            $this->redirect($this->getRedirectUrl());
        } catch (\Exception $exception) {
            send_admin_fail_notification($exception->getMessage());
        }
    }
}
