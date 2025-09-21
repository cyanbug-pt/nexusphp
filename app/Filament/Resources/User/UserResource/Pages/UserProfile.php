<?php

namespace App\Filament\Resources\User\UserResource\Pages;

use Filament\Actions\Contracts\HasActions;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Exception;
use Filament\Forms\Components\Radio;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Actions\DeleteAction;
use App\Filament\OptionsTrait;
use App\Filament\Resources\User\UserResource;
use App\Models\Exam;
use App\Models\Invite;
use App\Models\Medal;
use App\Models\User;
use App\Models\UserMeta;
use App\Repositories\ExamRepository;
use App\Repositories\MedalRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Concerns\HasRelationManagers;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Auth;
use Nexus\Database\NexusDB;

class UserProfile extends ViewRecord implements HasActions
{
    use InteractsWithRecord;
    use HasRelationManagers;
    use OptionsTrait;

    private static $rep;

    protected static string $resource = UserResource::class;

//    protected static string $view = 'filament.resources.user.user-resource.pages.user-profile';

    private function getRep(): UserRepository
    {
        if (!self::$rep) {
            self::$rep = new UserRepository();
        }
        return self::$rep;
    }

    protected function getHeaderActions(): array
    {
        $actions = [];
        if (Auth::user()->class > $this->record->class) {
            $actions[] = $this->buildGrantPropsAction();
            $actions[] = $this->buildGrantMedalAction();
            $actions[] = $this->buildAssignExamAction();
            $actions[] = $this->buildChangeBonusEtcAction();
//            if ($this->record->two_step_secret) {
//                $actions[] = $this->buildDisableTwoStepAuthenticationAction();
//            }
//            if ($this->record->status == User::STATUS_PENDING) {
//                $actions[] = $this->buildConfirmAction();
//            }
            $actions[] = $this->buildResetPasswordAction();
//            $actions[] = $this->buildEnableDisableAction();
//            $actions[] = $this->buildEnableDisableDownloadPrivilegesAction();
//            if (user_can('user-change-class')) {
//                $actions[] = $this->buildChangeClassAction();
//            }
            if (user_can('user-delete')) {
                $actions[] = $this->buildDeleteAction();
            }
            $actions = apply_filter('user_profile_actions', $actions);
        }
        return $actions;
    }

    private function buildEnableDisableAction(): Action
    {
        return Action::make('enable_disable')
            ->label($this->record->enabled == 'yes' ? __('admin.resources.user.actions.disable_modal_btn') : __('admin.resources.user.actions.enable_modal_btn'))
            ->modalHeading($this->record->enabled == 'yes' ? __('admin.resources.user.actions.disable_modal_title') : __('admin.resources.user.actions.enable_modal_title'))
            ->schema([
                TextInput::make('reason')->label(__('admin.resources.user.actions.enable_disable_reason'))->placeholder(__('admin.resources.user.actions.enable_disable_reason_placeholder')),
                Hidden::make('action')->default($this->record->enabled == 'yes' ? 'disable' : 'enable'),
                Hidden::make('uid')->default($this->record->id),
            ])
//            ->visible(false)
//            ->hidden(true)
            ->action(function ($data) {
                $userRep = $this->getRep();
                try {
                    if ($data['action'] == 'enable') {
                        $userRep->enableUser(Auth::user(), $data['uid'], $data['reason']);
                    } elseif ($data['action'] == 'disable') {
                        $userRep->disableUser(Auth::user(), $data['uid'], $data['reason']);
                    }
                    $this->sendSuccessNotification();
                } catch (Exception $exception) {
                    $this->sendFailNotification($exception->getMessage());
                }
            });
    }

    private function buildDisableTwoStepAuthenticationAction(): Action
    {
        return Action::make(__('admin.resources.user.actions.disable_two_step_authentication'))
            ->modalHeading(__('admin.resources.user.actions.disable_two_step_authentication'))
            ->requiresConfirmation()
            ->action(function ($data) {
                $userRep = $this->getRep();
                try {
                    $userRep->removeTwoStepAuthentication(Auth::user(), $this->record->id);
                    $this->sendSuccessNotification();
                } catch (Exception $exception) {
                    $this->sendFailNotification($exception->getMessage());
                }
            });
    }

    private function buildChangeBonusEtcAction(): Action
    {
        return Action::make(__('admin.resources.user.actions.change_bonus_etc_btn'))
            ->modalHeading(__('admin.resources.user.actions.change_bonus_etc_btn'))
            ->schema([
                Radio::make('field')->options([
                    'uploaded' => __('label.user.uploaded'),
                    'downloaded' => __('label.user.downloaded'),
                    'invites' => __('label.user.invites'),
                    'seedbonus' => __('label.user.seedbonus'),
                    'attendance_card' => __('label.user.attendance_card'),
                    'tmp_invites' => __('label.user.tmp_invites'),
                ])
                    ->label(__('admin.resources.user.actions.change_bonus_etc_field_label'))
                    ->inline()
                    ->required()
                    ->reactive()
                ,
                Radio::make('action')->options([
                    'Increment' => __("admin.resources.user.actions.change_bonus_etc_action_increment"),
                    'Decrement' => __("admin.resources.user.actions.change_bonus_etc_action_decrement"),
                ])
                    ->label(__('admin.resources.user.actions.change_bonus_etc_action_label'))
                    ->inline()
                    ->required()
                ,
                TextInput::make('value')->integer()->required()
                    ->label(__('admin.resources.user.actions.change_bonus_etc_value_label'))
                    ->helperText(__('admin.resources.user.actions.change_bonus_etc_value_help'))
                ,

                TextInput::make('duration')->integer()
                    ->label(__('admin.resources.user.actions.change_bonus_etc_duration_label'))
                    ->helperText(__('admin.resources.user.actions.change_bonus_etc_duration_help'))
                    ->hidden(fn (Get $get) => $get('field') != 'tmp_invites')
                ,

                TextInput::make('reason')
                    ->label(__('admin.resources.user.actions.change_bonus_etc_reason_label'))
                ,
            ])
            ->action(function ($data) {
                $userRep = $this->getRep();
                try {
                    if ($data['field'] == 'tmp_invites') {
                        $userRep->addTemporaryInvite(Auth::user(), $this->record->id, $data['action'], $data['value'], $data['duration'], $data['reason']);
                    } else {
                        $userRep->incrementDecrement(Auth::user(), $this->record->id, $data['action'], $data['field'], $data['value'], $data['reason']);
                    }
                    $this->sendSuccessNotification();
                } catch (Exception $exception) {
                    $this->sendFailNotification($exception->getMessage());
                }
            });
    }

    private function buildResetPasswordAction()
    {
        return Action::make(__('admin.resources.user.actions.reset_password_btn'))
            ->modalHeading(__('admin.resources.user.actions.reset_password_btn'))
            ->schema([
                TextInput::make('password')->label(__('admin.resources.user.actions.reset_password_label'))->required(),
                TextInput::make('password_confirmation')
                    ->label(__('admin.resources.user.actions.reset_password_confirmation_label'))
                    ->same('password')
                    ->required(),
            ])
            ->action(function ($data) {
                $userRep = $this->getRep();
                try {
                    $userRep->resetPassword($this->record->id, $data['password'], $data['password_confirmation']);
                    $this->sendSuccessNotification();
                } catch (Exception $exception) {
                    $this->sendFailNotification($exception->getMessage());
                }
            });
    }

    private function buildAssignExamAction()
    {
        return Action::make(__('admin.resources.user.actions.assign_exam_btn'))
            ->modalHeading(__('admin.resources.user.actions.assign_exam_btn'))
            ->schema([
                Select::make('exam_id')
                    ->options((new ExamRepository())->listMatchExam($this->record->id)->pluck('name', 'id'))
                    ->label(__('admin.resources.user.actions.assign_exam_exam_label'))->required(),
                DateTimePicker::make('begin')->label(__('admin.resources.user.actions.assign_exam_begin_label')),
                DateTimePicker::make('end')->label(__('admin.resources.user.actions.assign_exam_end_label'))
                    ->helperText(__('admin.resources.user.actions.assign_exam_end_help')),

            ])
            ->action(function ($data) {
                $examRep = new ExamRepository();
                try {
                    $examRep->assignToUser($this->record->id, $data['exam_id'], $data['begin'], $data['end']);
                    $this->sendSuccessNotification();
                } catch (Exception $exception) {
                    $this->sendFailNotification($exception->getMessage());
                }
            });
    }

    private function buildGrantMedalAction()
    {
        return Action::make(__('admin.resources.user.actions.grant_medal_btn'))
            ->modalHeading(__('admin.resources.user.actions.grant_medal_btn'))
            ->schema([
                Select::make('medal_id')
                    ->options(Medal::query()->pluck('name', 'id'))
                    ->label(__('admin.resources.user.actions.grant_medal_medal_label'))
                    ->required(),

                TextInput::make('duration')
                    ->label(__('admin.resources.user.actions.grant_medal_duration_label'))
                    ->helperText(__('admin.resources.user.actions.grant_medal_duration_help'))
                    ->integer(),

            ])
            ->action(function ($data) {
                $medalRep = new MedalRepository();
                try {
                    $medalRep->grantToUser($this->record->id, $data['medal_id'], $data['duration']);
                    $this->sendSuccessNotification();
                } catch (Exception $exception) {
                    $this->sendFailNotification($exception->getMessage());
                }
            });
    }

    private function buildConfirmAction()
    {
        return Action::make(__('admin.resources.user.actions.confirm_btn'))
            ->modalHeading(__('admin.resources.user.actions.confirm_btn'))
            ->requiresConfirmation()
            ->action(function () {
                if (Auth::user()->class <= $this->record->class) {
                    send_admin_fail_notification("No permission!");
                    return;
                }
                $this->record->status = User::STATUS_CONFIRMED;
                $this->record->info= null;
                $this->record->save();
                $this->sendSuccessNotification();
            });
    }


    private function buildEnableDisableDownloadPrivilegesAction(): Action
    {
        return Action::make($this->record->downloadpos == 'yes' ? __('admin.resources.user.actions.disable_download_privileges_btn') : __('admin.resources.user.actions.enable_download_privileges_btn'))
//            ->modalHeading($this->record->enabled == 'yes' ? __('admin.resources.user.actions.disable_modal_title') : __('admin.resources.user.actions.enable_modal_title'))
            ->requiresConfirmation()
            ->action(function () {
                $userRep = $this->getRep();
                try {
                    $userRep->updateDownloadPrivileges(Auth::user(), $this->record->id, $this->record->downloadpos == 'yes' ? 'no' : 'yes');
                    $this->sendSuccessNotification();
                } catch (Exception $exception) {
                    $this->sendFailNotification($exception->getMessage());
                }
            });
    }

    private function buildGrantPropsAction()
    {
        return Action::make(__('admin.resources.user.actions.grant_prop_btn'))
            ->modalHeading(__('admin.resources.user.actions.grant_prop_btn'))
            ->schema([
                Select::make('meta_key')
                    ->options(UserMeta::listProps())
                    ->label(__('admin.resources.user.actions.grant_prop_form_prop'))->required(),
                TextInput::make('duration')->label(__('admin.resources.user.actions.grant_prop_form_duration'))
                    ->helperText(__('admin.resources.user.actions.grant_prop_form_duration_help')),

            ])
            ->action(function ($data) {
                $rep = $this->getRep();
                try {
                    $rep->addMeta($this->record, $data, $data);
                    $this->sendSuccessNotification();
                } catch (Exception $exception) {
                    $this->sendFailNotification($exception->getMessage());
                }
            });
    }

    private function buildDeleteAction(): DeleteAction
    {
        return DeleteAction::make()->using(function () {
            $this->getRep()->destroy($this->record->id);
            return redirect(self::$resource::getUrl('index'));
        });
    }

    public function getViewData(): array
    {
        return [
            'props' => $this->listUserProps(),
            'temporary_invite_count' => $this->countTemporaryInvite()
        ];
    }

    private function listUserProps(): array
    {
        $metaKeys = [
            UserMeta::META_KEY_PERSONALIZED_USERNAME,
            UserMeta::META_KEY_CHANGE_USERNAME,
        ];
        $metaList = $this->getRep()->listMetas($this->record->id, $metaKeys);
        $props = [];
        foreach ($metaList as $metaKey => $metas) {
            $meta = $metas->first();
            $text = sprintf('[%s]', $meta->metaKeyText);
            if ($meta->meta_key == UserMeta::META_KEY_PERSONALIZED_USERNAME) {
                $text .= sprintf('(%s)', $meta->getDeadlineText());
            }
            $props[] = "<div>{$text}</div>";
        }
        return $props;
    }

    private function countTemporaryInvite()
    {
        return Invite::query()->where('inviter', $this->record->id)
            ->where('invitee', '')
            ->whereNotNull('expired_at')
            ->where('expired_at', '>', Carbon::now())
            ->count();
    }

    private function buildChangeClassAction(): Action
    {
        return Action::make('change_class')
            ->label(__('admin.resources.user.actions.change_class_btn'))
            ->schema([
                Select::make('class')
                    ->options(User::listClass(User::CLASS_PEASANT, Auth::user()->class - 1))
                    ->default($this->record->class)
                    ->label(__('user.labels.class'))
                    ->required()
                    ->reactive()
                ,
                Radio::make('vip_added')
                    ->options(self::getYesNoOptions('yes', 'no'))
                    ->default($this->record->vip_added)
                    ->label(__('user.labels.vip_added'))
                    ->helperText(__('user.labels.vip_added_help'))
                    ->hidden(fn (Get $get) => $get('class') != User::CLASS_VIP)
                ,
                DateTimePicker::make('vip_until')
                    ->default($this->record->vip_until)
                    ->label(__('user.labels.vip_until'))
                    ->helperText(__('user.labels.vip_until_help'))
                    ->hidden(fn (Get $get) => $get('class') != User::CLASS_VIP)
                ,
                TextInput::make('reason')
                    ->label(__('admin.resources.user.actions.enable_disable_reason'))
                    ->placeholder(__('admin.resources.user.actions.enable_disable_reason_placeholder'))
                ,
            ])
            ->action(function ($data) {
                $userRep = $this->getRep();
                try {
                    $userRep->changeClass(Auth::user(), $this->record, $data['class'], $data['reason'], $data);
                    $this->sendSuccessNotification();
                } catch (Exception $exception) {
                    $this->sendFailNotification($exception->getMessage());
                }
            });
    }

    private function sendSuccessNotification(string $msg = ""): void
    {
        Notification::make()
            ->success()
            ->title($msg ?: "Success!")
            ->send()
        ;
    }

    private function sendFailNotification(string $msg = ""): void
    {
        Notification::make()
            ->danger()
            ->title($msg ?: "Fail!")
            ->send()
        ;
    }
}
