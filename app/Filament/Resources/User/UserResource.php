<?php

namespace App\Filament\Resources\User;

use App\Filament\OptionsTrait;
use App\Filament\Resources\User\UserResource\Pages;
use App\Filament\Resources\User\UserResource\RelationManagers;
use App\Models\User;
use App\Repositories\UserRepository;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

class UserResource extends Resource
{
    use OptionsTrait;

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'User';

    protected static ?int $navigationSort = 1;

    private static $rep;

    private static function getRep(): UserRepository
    {
        if (!self::$rep) {
            self::$rep = new UserRepository();
        }
        return self::$rep;
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.users_list');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('username')->required(),
                Forms\Components\TextInput::make('email')->required(),
                Forms\Components\TextInput::make('password')->password()->required()->visibleOn(Pages\CreateUser::class),
                Forms\Components\TextInput::make('password_confirmation')->password()->required()->same('password')->visibleOn(Pages\CreateUser::class),
                Forms\Components\TextInput::make('id')->integer(),
                Forms\Components\Select::make('class')->options(User::listClass(User::CLASS_PEASANT, Auth::user()->class - 1)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('username')->searchable()->label(__("label.user.username"))
                    ->formatStateUsing(fn ($record) => new HtmlString(get_username($record->id, false, true, true, true))),
                Tables\Columns\TextColumn::make('email')->searchable()->label(__("label.email")),
                Tables\Columns\TextColumn::make('class')->label('Class')
                    ->formatStateUsing(fn(Tables\Columns\Column $column) => $column->getRecord()->classText)
                    ->sortable()->label(__("label.user.class")),
                Tables\Columns\TextColumn::make('uploaded')->label('Uploaded')
                    ->formatStateUsing(fn(Tables\Columns\Column $column) => $column->getRecord()->uploadedText)
                    ->sortable()->label(__("label.uploaded")),
                Tables\Columns\TextColumn::make('downloaded')->label('Downloaded')
                    ->formatStateUsing(fn(Tables\Columns\Column $column) => $column->getRecord()->downloadedText)
                    ->sortable()->label(__("label.downloaded")),
                Tables\Columns\BadgeColumn::make('status')->colors(['success' => 'confirmed', 'warning' => 'pending'])->label(__("label.user.status")),
                Tables\Columns\BadgeColumn::make('enabled')->colors(['success' => 'yes', 'danger' => 'no'])->label(__("label.user.enabled")),
                Tables\Columns\BadgeColumn::make('downloadpos')->colors(['success' => 'yes', 'danger' => 'no'])->label(__("label.user.downloadpos")),
                Tables\Columns\BadgeColumn::make('parked')->colors(['success' => 'yes', 'danger' => 'no'])->label(__("label.user.parked")),
                Tables\Columns\TextColumn::make('added')->sortable()->dateTime('Y-m-d H:i')->label(__("label.added")),
                Tables\Columns\TextColumn::make('last_access')->dateTime()->label(__("label.last_access")),
            ])
            ->defaultSort('added', 'desc')
            ->filters([
                Tables\Filters\Filter::make('id')
                    ->form([
                        Forms\Components\TextInput::make('id')
                            ->placeholder('UID')
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['id'], fn (Builder $query, $id) => $query->where("id", $id));
                    })
                ,
                Tables\Filters\SelectFilter::make('class')->options(array_column(User::$classes, 'text'))->label(__('label.user.class')),
                Tables\Filters\SelectFilter::make('status')->options(['confirmed' => 'confirmed', 'pending' => 'pending'])->label(__('label.user.status')),
                Tables\Filters\SelectFilter::make('enabled')->options(self::$yesOrNo)->label(__('label.user.enabled')),
                Tables\Filters\SelectFilter::make('downloadpos')->options(self::$yesOrNo)->label(__('label.user.downloadpos')),
                Tables\Filters\SelectFilter::make('parked')->options(self::$yesOrNo)->label(__('label.user.parked')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions(self::getBulkActions());
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Grid::make(2)->schema([
                    Components\Group::make([
                        Infolists\Components\TextEntry::make('id')->label("UID"),
                        Infolists\Components\TextEntry::make('username')
                            ->label(__("label.user.username"))
                            ->formatStateUsing(fn ($record) => get_username($record->id, false, true, true, true))
                            ->html()
                        ,
                        Infolists\Components\TextEntry::make('email')
                            ->label(__("label.email"))
                            ->copyable()
                            ->placeholder("点击复制")
                        ,
                        Infolists\Components\TextEntry::make('passkey')->limit(10)->copyable(),
                        Infolists\Components\TextEntry::make('added')->label(__("label.added")),
                        Infolists\Components\TextEntry::make('last_access')->label(__("label.last_access")),
                        Infolists\Components\TextEntry::make('inviter.username')->label(__("label.user.invite_by")),
                        Infolists\Components\TextEntry::make('parked')->label(__("label.user.parked")),
                        Infolists\Components\TextEntry::make('offer_allowed_count')->label(__("label.user.offer_allowed_count")),
                        Infolists\Components\TextEntry::make('seed_points')->label(__("label.user.seed_points")),
                        Infolists\Components\TextEntry::make('uploadedText')->label(__("label.uploaded")),
                        Infolists\Components\TextEntry::make('downloadedText')->label(__("label.downloaded")),
                        Infolists\Components\TextEntry::make('seedbonus')->label(__("label.user.seedbonus")),
                        Infolists\Components\TextEntry::make('seed_points')->label(__("label.user.seed_points")),
                    ])
                        ->columns(6)
                        ->columnSpan(4)
                    ,

                    Components\Group::make([
                        Infolists\Components\TextEntry::make('status')
                            ->label(__('label.user.status'))
                            ->badge()
                            ->colors(['success' => User::STATUS_CONFIRMED, 'warning' => User::STATUS_PENDING])
                            ->hintAction(self::buildActionConfirm())
                        ,

                        Infolists\Components\TextEntry::make('classText')
                            ->label(__("label.user.class"))
                            ->hintAction(self::buildActionChangeClass())
                        ,

                        Infolists\Components\TextEntry::make('enabled')
                            ->label(__("label.user.enabled"))
                            ->badge()
                            ->colors(['success' => 'yes', 'warning' => 'no'])
                            ->hintAction(self::buildActionEnableDisable())
                        ,
                        Infolists\Components\TextEntry::make('downloadpos')
                            ->label(__("label.user.downloadpos"))
                            ->badge()
                            ->colors(['success' => 'yes', 'warning' => 'no'])
                            ->hintAction(self::buildActionChangeDownloadPos())
                        ,
                        Infolists\Components\TextEntry::make('twoFactorAuthenticationStatus')
                            ->label(__("label.user.two_step_authentication"))
                            ->badge()
                            ->colors(['success' => 'yes', 'warning' => 'no'])
                            ->hintAction(self::buildActionCancelTwoStepAuthentication())
                        ,
                    ])
                        ->columnSpan(1)
                ])->columns(5),
            ]);
    }

    private static function buildActionChangeClass(): Infolists\Components\Actions\Action
    {
        return Infolists\Components\Actions\Action::make("changeClass")
            ->label(__('label.change'))
            ->button()
            ->visible(fn (User $record): bool => (Auth::user()->class > $record->class))
            ->form([
                Forms\Components\Select::make('class')
                    ->options(User::listClass(User::CLASS_PEASANT, Auth::user()->class - 1))
                    ->default(fn (User $record) => $record->class)
                    ->label(__('user.labels.class'))
                    ->required()
                    ->reactive()
                ,
                Forms\Components\Radio::make('vip_added')
                    ->options(self::getYesNoOptions('yes', 'no'))
                    ->default(fn (User $record) => $record->vip_added)
                    ->label(__('user.labels.vip_added'))
                    ->helperText(__('user.labels.vip_added_help'))
                    ->hidden(fn (\Filament\Forms\Get $get) => $get('class') != User::CLASS_VIP)
                ,
                Forms\Components\DateTimePicker::make('vip_until')
                    ->default(fn (User $record) => $record->vip_until)
                    ->label(__('user.labels.vip_until'))
                    ->helperText(__('user.labels.vip_until_help'))
                    ->hidden(fn (\Filament\Forms\Get $get) => $get('class') != User::CLASS_VIP)
                ,
                Forms\Components\TextInput::make('reason')
                    ->label(__('admin.resources.user.actions.enable_disable_reason'))
                    ->placeholder(__('admin.resources.user.actions.enable_disable_reason_placeholder'))
                ,
            ])
            ->action(function (User $record, array $data) {
                $userRep = self::getRep();
                try {
                    $userRep->changeClass(Auth::user(), $record, $data['class'], $data['reason'], $data);
                    send_admin_success_notification();
                } catch (\Exception $exception) {
                    send_admin_fail_notification($exception->getMessage());
                }
            });
    }

    private static function buildActionConfirm(): Infolists\Components\Actions\Action
    {
        return Infolists\Components\Actions\Action::make(__('admin.resources.user.actions.confirm_btn'))
            ->modalHeading(__('admin.resources.user.actions.confirm_btn'))
            ->requiresConfirmation()
            ->visible(fn (User $record): bool => (Auth::user()->class > $record->class))
            ->button()
            ->color('success')
            ->visible(fn ($record) => $record->status == User::STATUS_PENDING)
            ->action(function (User $record) {
                if (Auth::user()->class <= $record->class) {
                    send_admin_fail_notification("No Permission!");
                    return;
                }
                $record->status = User::STATUS_CONFIRMED;
                $record->info= null;
                $record->save();
                send_admin_success_notification();
            });
    }

    private static function buildActionEnableDisable(): Infolists\Components\Actions\Action
    {
        return Infolists\Components\Actions\Action::make("changeClass")
            ->label(fn (User $record) => $record->enabled == 'yes' ? __('admin.resources.user.actions.disable_modal_btn') : __('admin.resources.user.actions.enable_modal_btn'))
            ->modalHeading(fn (User $record) => $record->enabled == 'yes' ? __('admin.resources.user.actions.disable_modal_title') : __('admin.resources.user.actions.enable_modal_title'))
            ->button()
            ->visible(fn (User $record): bool => (Auth::user()->class > $record->class))
            ->form([
                Forms\Components\TextInput::make('reason')->label(__('admin.resources.user.actions.enable_disable_reason'))->placeholder(__('admin.resources.user.actions.enable_disable_reason_placeholder')),
                Forms\Components\Hidden::make('action')->default(fn (User $record) => $record->enabled == 'yes' ? 'disable' : 'enable'),
                Forms\Components\Hidden::make('uid')->default(fn (User $record) => $record->id),
            ])
            ->action(function (User $record, array $data) {
                $userRep = self::getRep();
                try {
                    if ($data['action'] == 'enable') {
                        $userRep->enableUser(Auth::user(), $data['uid'], $data['reason']);
                    } elseif ($data['action'] == 'disable') {
                        $userRep->disableUser(Auth::user(), $data['uid'], $data['reason']);
                    }
                    send_admin_success_notification();
                } catch (\Exception $exception) {
                    send_admin_fail_notification($exception->getMessage());
                }
            });
    }

    private static function buildActionChangeDownloadPos(): Infolists\Components\Actions\Action
    {
        return Infolists\Components\Actions\Action::make("changeDownloadPos")
            ->label(fn (User $record) => $record->downloadpos == 'yes' ? __('admin.resources.user.actions.disable_download_privileges_btn') : __('admin.resources.user.actions.enable_download_privileges_btn'))
            ->button()
            ->requiresConfirmation()
            ->visible(fn (User $record): bool => (Auth::user()->class > $record->class))
            ->action(function (User $record) {
                $userRep = self::getRep();
                try {
                    $userRep->updateDownloadPrivileges(Auth::user(), $record->id, $record->downloadpos == 'yes' ? 'no' : 'yes');
                    send_admin_success_notification();
                } catch (\Exception $exception) {
                    send_admin_fail_notification($exception->getMessage());
                }
            });

    }

    private static function buildActionCancelTwoStepAuthentication(): Infolists\Components\Actions\Action
    {
        return Infolists\Components\Actions\Action::make("twoStepAuthentication")
            ->label(__('admin.resources.user.actions.disable_two_step_authentication'))
            ->button()
            ->visible(fn (User $record) => $record->two_step_secret != "")
            ->modalHeading(__('admin.resources.user.actions.disable_two_step_authentication'))
            ->requiresConfirmation()
            ->action(function (user $record) {
                $userRep = self::getRep();
                try {
                    $userRep->removeTwoStepAuthentication(Auth::user(), $record->id);
                    send_admin_success_notification();
                } catch (\Exception $exception) {
                    send_admin_fail_notification($exception->getMessage());
                }
            });

    }

    public static function getRelations(): array
    {
        return [
//            RelationManagers\MedalsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
//            'edit' => Pages\EditUser::route('/{record}/edit'),
//            'view' => Pages\ViewUser::route('/{record}'),
            'view' => Pages\UserProfile::route('/{record}'),
        ];
    }

    public static function getBulkActions(): array
    {
        $actions = [];
        if (filament()->auth()->user()->class >= User::CLASS_SYSOP) {
            $actions[] = Tables\Actions\BulkAction::make('confirm')
                ->label(__('admin.resources.user.actions.confirm_bulk'))
                ->requiresConfirmation()
                ->deselectRecordsAfterCompletion()
                ->action(function (Collection $records) {
                    $rep = self::getRep();
                    $rep->confirmUser($records->pluck('id')->toArray());
                });
        }

        return $actions;
    }

}
