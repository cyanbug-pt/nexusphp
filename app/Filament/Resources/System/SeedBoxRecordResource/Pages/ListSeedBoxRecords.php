<?php

namespace App\Filament\Resources\System\SeedBoxRecordResource\Pages;

use App\Exceptions\SeedBoxYesException;
use App\Filament\PageList;
use App\Filament\Resources\System\SeedBoxRecordResource;
use Filament\Pages\Actions;
use Filament\Forms;

class ListSeedBoxRecords extends PageList
{
    protected static string $resource = SeedBoxRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('check')
                ->label(__('admin.resources.seed_box_record.check_modal_btn'))
                ->form([
                    Forms\Components\TextInput::make('ip')->required()->label('IP'),
                    Forms\Components\TextInput::make('uid')->required()->label('UID'),
                ])
                ->modalHeading(__('admin.resources.seed_box_record.check_modal_header'))
                ->action(function ($data) {
                    try {
                        isIPSeedBox($data['ip'], $data['uid'], true, true);
                        $this->notify('success', nexus_trans("seed-box.is_seed_box_no"));
                    } catch (SeedBoxYesException $exception) {
                        $this->notify('danger', nexus_trans("seed-box.is_seed_box_yes", ['id' => $exception->getId()]));
                    } catch (\Throwable $throwable) {
                        do_log($throwable->getMessage() . $throwable->getTraceAsString(), "error");
                        $this->notify('danger', $throwable->getMessage());
                    }
                })
        ];
    }
}
