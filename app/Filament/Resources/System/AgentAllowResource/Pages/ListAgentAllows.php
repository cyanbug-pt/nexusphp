<?php

namespace App\Filament\Resources\System\AgentAllowResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Exception;
use App\Filament\PageList;
use App\Filament\Resources\System\AgentAllowResource;
use App\Repositories\AgentAllowRepository;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms;

class ListAgentAllows extends PageList
{
    protected static string $resource = AgentAllowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('check')
                ->label(__('admin.resources.agent_allow.check_modal_btn'))
                ->schema([
                    TextInput::make('peer_id')->required(),
                    TextInput::make('agent')->required(),
                ])
                ->modalHeading(__('admin.resources.agent_allow.check_modal_header'))
                ->action(function ($data) {
                    $agentAllowRep = new AgentAllowRepository();
                    try {
                        $result = $agentAllowRep->checkClient($data['peer_id'], $data['agent']);
                        send_admin_success_notification(__('admin.resources.agent_allow.check_pass_msg', ['id' => $result->id]));
                    } catch (Exception $exception) {
                        send_admin_fail_notification($exception->getMessage());
                    }
                })

        ];
    }

}
