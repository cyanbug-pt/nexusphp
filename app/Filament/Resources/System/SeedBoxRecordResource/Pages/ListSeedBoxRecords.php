<?php

namespace App\Filament\Resources\System\SeedBoxRecordResource\Pages;

use App\Filament\PageList;
use App\Filament\Resources\System\SeedBoxRecordResource;
use App\Repositories\SeedBoxRepository;
use Filament\Actions;
use Filament\Forms;
use Illuminate\Support\HtmlString;

class ListSeedBoxRecords extends PageList
{
    protected static string $resource = SeedBoxRecordResource::class;

    protected static ?array $checkResult = null;

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
                ->action(function (array $data) {
                    $result = SeedBoxRepository::isSeedBoxFromUserRecords($data['uid'], $data['ip']);
                    self::$checkResult = $result;
//                    return $result;
//                    $this->replaceMountedAction("checkResult", ['result' => $result]);
//                    if ($checkResult['result']) {
//                        send_admin_success_notification(nexus_trans("seed-box.is_seed_box_yes", ['desc' => $checkResult['desc']]));
//                    } else {
//                        send_admin_fail_notification(nexus_trans("seed-box.is_seed_box_no", ['desc' => $checkResult['desc']]));
//                    }
                })
                ->registerModalActions([
                    Actions\Action::make('checkResult')
                        ->modalHeading(function () {
                            if (self::$checkResult !== null) {
                                if (self::$checkResult['result']) {
                                    return nexus_trans("seed-box.is_seed_box_yes");
                                } else {
                                    return nexus_trans("seed-box.is_seed_box_no");
                                }
                            }
                            return 'Unknown';
                        })
                        ->action(null)
                        ->modalSubmitAction(false)
                        ->modalCancelAction(false)
                        ->modalDescription(fn () => new HtmlString(self::$checkResult['desc'] ?? ''))
//                        ->modalContent(fn () => new HtmlString(self::$checkResult['desc'] ?? ''))
                ])
                ->after(function() {
                    $this->mountAction("checkResult");
                    })
            ,
        ];
    }

}
