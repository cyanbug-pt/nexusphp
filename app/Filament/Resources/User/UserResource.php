<?php

namespace App\Filament\Resources\User;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\User\UserResource\Pages\CreateUser;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\ViewAction;
use Filament\Schemas\Components\Group;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\Radio;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\DateTimePicker;
use Exception;
use Filament\Forms\Components\Hidden;
use App\Filament\Resources\User\UserResource\Pages\ListUsers;
use App\Filament\Resources\User\UserResource\Pages\UserProfile;
use Filament\Actions\BulkAction;
use App\Filament\OptionsTrait;
use App\Filament\Resources\User\UserResource\Pages;
use App\Filament\Resources\User\UserResource\RelationManagers;
use App\Models\User;
use App\Repositories\UserRepository;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Infolists;
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

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-users';

    protected static string | \UnitEnum | null $navigationGroup = 'User';

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

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('username')->required(),
                TextInput::make('email')->required(),
                TextInput::make('password')->password()->required()->visibleOn(CreateUser::class),
                TextInput::make('password_confirmation')->password()->required()->same('password')->visibleOn(CreateUser::class),
                TextInput::make('id')->integer(),
                Select::make('class')->options(User::listClass(User::CLASS_PEASANT, Auth::user()->class - 1)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable(),
                TextColumn::make('username')->searchable()->label(__("label.user.username"))
                    ->formatStateUsing(fn ($record) => new HtmlString(get_username($record->id, false, true, true, true))),
                TextColumn::make('email')->searchable()->label(__("label.email")),
                TextColumn::make('class')->label('Class')
                    ->formatStateUsing(fn(Column $column) => $column->getRecord()->classText)
                    ->sortable()->label(__("label.user.class")),
                TextColumn::make('uploaded')->label('Uploaded')
                    ->formatStateUsing(fn(Column $column) => $column->getRecord()->uploadedText)
                    ->sortable()->label(__("label.uploaded")),
                TextColumn::make('downloaded')->label('Downloaded')
                    ->formatStateUsing(fn(Column $column) => $column->getRecord()->downloadedText)
                    ->sortable()->label(__("label.downloaded")),
                BadgeColumn::make('status')->colors(['success' => 'confirmed', 'warning' => 'pending'])->label(__("label.user.status")),
                BadgeColumn::make('enabled')->colors(['success' => 'yes', 'danger' => 'no'])->label(__("label.user.enabled")),
                BadgeColumn::make('downloadpos')->colors(['success' => 'yes', 'danger' => 'no'])->label(__("label.user.downloadpos")),
                BadgeColumn::make('parked')->colors(['success' => 'yes', 'danger' => 'no'])->label(__("label.user.parked")),
                TextColumn::make('added')->sortable()->dateTime('Y-m-d H:i')->label(__("label.added")),
                TextColumn::make('last_access')->dateTime('Y-m-d H:i')->label(__("label.last_access")),
            ])
            ->defaultSort('added', 'desc')
            ->filters([
                Filter::make('id')
                    ->schema([
                        TextInput::make('id')
                            ->placeholder('UID')
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['id'], fn (Builder $query, $id) => $query->where("id", $id));
                    })
                ,
                SelectFilter::make('class')->options(array_column(User::$classes, 'text'))->label(__('label.user.class')),
                SelectFilter::make('status')->options(['confirmed' => 'confirmed', 'pending' => 'pending'])->label(__('label.user.status')),
                SelectFilter::make('enabled')->options(self::$yesOrNo)->label(__('label.user.enabled')),
                SelectFilter::make('downloadpos')->options(self::$yesOrNo)->label(__('label.user.downloadpos')),
                SelectFilter::make('parked')->options(self::$yesOrNo)->label(__('label.user.parked')),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions(self::getBulkActions());
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Grid::make(2)->schema([
                    Group::make([
                        TextEntry::make('id')->label("UID"),
                        TextEntry::make('username')
                            ->label(__("label.user.username"))
                            ->formatStateUsing(fn ($record) => get_username($record->id, false, true, true, true))
                            ->html()
                        ,
                        TextEntry::make('email')
                            ->label(__("label.email"))
                            ->copyable()
                            ->placeholder("点击复制")
                        ,
                        TextEntry::make('passkey')->limit(10)->copyable(),
                        TextEntry::make('added')->label(__("label.added")),
                        TextEntry::make('last_access')->label(__("label.last_access")),
                        TextEntry::make('inviter.username')->label(__("label.user.invite_by")),
                        TextEntry::make('parked')->label(__("label.user.parked")),
                        TextEntry::make('offer_allowed_count')->label(__("label.user.offer_allowed_count")),
                        TextEntry::make('seed_points')->label(__("label.user.seed_points")),
                        TextEntry::make('uploadedText')->label(__("label.uploaded")),
                        TextEntry::make('downloadedText')->label(__("label.downloaded")),
                        TextEntry::make('seedbonus')->label(__("label.user.seedbonus")),
                        TextEntry::make('seed_points')->label(__("label.user.seed_points")),
                    ])
                        ->columns(6)
                        ->columnSpan(4)
                    ,

                    Group::make([
                        TextEntry::make('status')
                            ->label(__('label.user.status'))
                            ->badge()
                            ->colors(['success' => User::STATUS_CONFIRMED, 'warning' => User::STATUS_PENDING])
                            ->hintAction(self::buildActionConfirm())
                        ,

                        TextEntry::make('classText')
                            ->label(__("label.user.class"))
                            ->hintAction(self::buildActionChangeClass())
                        ,

                        TextEntry::make('enabled')
                            ->label(__("label.user.enabled"))
                            ->badge()
                            ->colors(['success' => 'yes', 'warning' => 'no'])
                            ->hintAction(self::buildActionEnableDisable())
                        ,
                        TextEntry::make('downloadpos')
                            ->label(__("label.user.downloadpos"))
                            ->badge()
                            ->colors(['success' => 'yes', 'warning' => 'no'])
                            ->hintAction(self::buildActionChangeDownloadPos())
                        ,
                        TextEntry::make('twoFactorAuthenticationStatus')
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

    private static function buildActionChangeClass(): Action
    {
        return Action::make("changeClass")
            ->label(__('label.change'))
            ->button()
            ->visible(fn (User $record): bool => (Auth::user()->class > $record->class))
            ->schema([
                Select::make('class')
                    ->options(User::listClass(User::CLASS_PEASANT, Auth::user()->class - 1))
                    ->default(fn (User $record) => $record->class)
                    ->label(__('user.labels.class'))
                    ->required()
                    ->reactive()
                ,
                Radio::make('vip_added')
                    ->options(self::getYesNoOptions('yes', 'no'))
                    ->default(fn (User $record) => $record->vip_added)
                    ->label(__('user.labels.vip_added'))
                    ->helperText(__('user.labels.vip_added_help'))
                    ->hidden(fn (Get $get) => $get('class') != User::CLASS_VIP)
                ,
                DateTimePicker::make('vip_until')
                    ->default(fn (User $record) => $record->vip_until)
                    ->label(__('user.labels.vip_until'))
                    ->helperText(__('user.labels.vip_until_help'))
                    ->hidden(fn (Get $get) => $get('class') != User::CLASS_VIP)
                ,
                TextInput::make('reason')
                    ->label(__('admin.resources.user.actions.enable_disable_reason'))
                    ->placeholder(__('admin.resources.user.actions.enable_disable_reason_placeholder'))
                ,
            ])
            ->action(function (User $record, array $data) {
                $userRep = self::getRep();
                try {
                    $userRep->changeClass(Auth::user(), $record, $data['class'], $data['reason'], $data);
                    send_admin_success_notification();
                } catch (Exception $exception) {
                    send_admin_fail_notification($exception->getMessage());
                }
            });
    }

    private static function buildActionConfirm(): Action
    {
        return Action::make(__('admin.resources.user.actions.confirm_btn'))
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

    private static function buildActionEnableDisable(): Action
    {
        return Action::make("changeClass")
            ->label(fn (User $record) => $record->enabled == 'yes' ? __('admin.resources.user.actions.disable_modal_btn') : __('admin.resources.user.actions.enable_modal_btn'))
            ->modalHeading(fn (User $record) => $record->enabled == 'yes' ? __('admin.resources.user.actions.disable_modal_title') : __('admin.resources.user.actions.enable_modal_title'))
            ->button()
            ->visible(fn (User $record): bool => (Auth::user()->class > $record->class))
            ->schema([
                TextInput::make('reason')->label(__('admin.resources.user.actions.enable_disable_reason'))->placeholder(__('admin.resources.user.actions.enable_disable_reason_placeholder')),
                Hidden::make('action')->default(fn (User $record) => $record->enabled == 'yes' ? 'disable' : 'enable'),
                Hidden::make('uid')->default(fn (User $record) => $record->id),
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
                } catch (Exception $exception) {
                    send_admin_fail_notification($exception->getMessage());
                }
            });
    }

    private static function buildActionChangeDownloadPos(): Action
    {
        return Action::make("changeDownloadPos")
            ->label(fn (User $record) => $record->downloadpos == 'yes' ? __('admin.resources.user.actions.disable_download_privileges_btn') : __('admin.resources.user.actions.enable_download_privileges_btn'))
            ->button()
            ->requiresConfirmation()
            ->visible(fn (User $record): bool => (Auth::user()->class > $record->class))
            ->action(function (User $record) {
                $userRep = self::getRep();
                try {
                    $userRep->updateDownloadPrivileges(Auth::user(), $record->id, $record->downloadpos == 'yes' ? 'no' : 'yes');
                    send_admin_success_notification();
                } catch (Exception $exception) {
                    send_admin_fail_notification($exception->getMessage());
                }
            });

    }

    private static function buildActionCancelTwoStepAuthentication(): Action
    {
        return Action::make("twoStepAuthentication")
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
                } catch (Exception $exception) {
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
//            'edit' => Pages\EditUser::route('/{record}/edit'),
//            'view' => Pages\ViewUser::route('/{record}'),
            'view' => UserProfile::route('/{record}'),
        ];
    }

    public static function getBulkActions(): array
    {
        $actions = [];
        if (filament()->auth()->user()->class >= User::CLASS_SYSOP) {
            $actions[] = BulkAction::make('confirm')
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
