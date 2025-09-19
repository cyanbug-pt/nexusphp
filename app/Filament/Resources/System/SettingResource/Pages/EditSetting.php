<?php

namespace App\Filament\Resources\System\SettingResource\Pages;

use App\Auth\Permission;
use App\Filament\OptionsTrait;
use App\Filament\Resources\System\SettingResource;
use App\Models\HitAndRun;
use App\Models\SearchBox;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\Torrent;
use App\Models\User;
use App\Repositories\TokenRepository;
use App\Repositories\ToolRepository;
use Filament\Facades\Filament;
use Filament\Resources\Pages\Page;
use Filament\Forms;
use Illuminate\Support\HtmlString;
use Meilisearch\Contracts\Index\Settings;
use Nexus\Database\NexusDB;

class EditSetting extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms, OptionsTrait;

    protected static string $resource = SettingResource::class;

    protected static string $view = 'filament.resources.system.setting-resource.pages.edit-hit-and-run';

    public ?array $data = [];

    public function getTitle(): string
    {
        return __('label.setting.nav_text');
    }

    public function mount()
    {
        static::authorizeResourceAccess();
        $this->fillForm();
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema($this->getFormSchema())
            ->statePath('data');
    }

    private function fillForm()
    {
        $settings = Setting::getFromDb();
        $this->form->fill($settings);
    }



    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Tabs::make('Heading')
                ->tabs($this->getTabs())
        ];
    }

    public function submit()
    {
        static::authorizeResourceAccess();

        $formData = $this->form->getState();
        $notAutoloadNames = ['donation_custom'];
        $data = [];
        foreach ($formData as $prefix => $parts) {
            foreach ($parts as $name => $value) {
                if (in_array($name, $notAutoloadNames)) {
                    $autoload = 'no';
                } else {
                    $autoload = 'yes';
                }
                if (is_array($value)) {
                    $value = json_encode($value);
                }
                $data[] = [
                    'name' => "$prefix.$name",
                    'value' => $value,
                    'autoload' => $autoload,
                ];

            }
        }
        Setting::query()->upsert($data, ['name'], ['value']);
        $this->doAfterUpdate();
        do_action("nexus_setting_update");
        clear_setting_cache();
        send_admin_success_notification();
    }

    /**
     * this actions get config must not use cache !!!
     *
     * @return void
     */
    private function doAfterUpdate(): void
    {
        Setting::updateUserTokenPermissionAllowedCache();
    }

    private function getTabs(): array
    {
        $tabs = [];
        $tabs[] = Forms\Components\Tabs\Tab::make(__('label.setting.hr.tab_header'))
            ->id('hr')
            ->schema($this->getHitAndRunSchema())
            ->columns(2)
        ;
//        $tabs[] = Forms\Components\Tabs\Tab::make(__('label.setting.require_seed_section.tab_header'))
//            ->id('require_seed_section')
//            ->schema($this->getRequireSeedSectionSchema())
//            ->columns(2)
//        ;

        $tabs[] = Forms\Components\Tabs\Tab::make(__('label.setting.backup.tab_header'))
            ->id('backup')
            ->schema([
                Forms\Components\Radio::make('backup.enabled')->options(self::$yesOrNo)->inline(true)->label(__('label.enabled'))->helperText(__('label.setting.backup.enabled_help')),
                Forms\Components\Radio::make('backup.frequency')->options(['daily' => 'daily', 'hourly' => 'hourly'])->inline(true)->label(__('label.setting.backup.frequency'))->helperText(__('label.setting.backup.frequency_help')),
                Forms\Components\Select::make('backup.hour')->options(range(0, 23))->label(__('label.setting.backup.hour'))->helperText(__('label.setting.backup.hour_help')),
                Forms\Components\Select::make('backup.minute')->options(range(0, 59))->label(__('label.setting.backup.minute'))->helperText(__('label.setting.backup.minute_help')),
//                Forms\Components\TextInput::make('backup.google_drive_client_id')->label(__('label.setting.backup.google_drive_client_id')),
//                Forms\Components\TextInput::make('backup.google_drive_client_secret')->label(__('label.setting.backup.google_drive_client_secret')),
//                Forms\Components\TextInput::make('backup.google_drive_refresh_token')->label(__('label.setting.backup.google_drive_refresh_token')),
//                Forms\Components\TextInput::make('backup.google_drive_folder_id')->label(__('label.setting.backup.google_drive_folder_id')),
                Forms\Components\TextInput::make('backup.export_path')->label(__('label.setting.backup.export_path'))->helperText(new HtmlString(__('label.setting.backup.export_path_help', ['default_path' => ToolRepository::getBackupExportPathDefault()]))),
                Forms\Components\TextInput::make('backup.retention_count')->numeric()->label(__('label.setting.backup.retention_count'))->helperText(new HtmlString(__('label.setting.backup.retention_count_help', ['default_count' => ToolRepository::BACKUP_RETENTION_COUNT_DEFAULT]))),
                Forms\Components\Radio::make('backup.via_ftp')->options(self::$yesOrNo)->inline(true)->label(__('label.setting.backup.via_ftp'))->helperText(new HtmlString(__('label.setting.backup.via_ftp_help'))),
                Forms\Components\Radio::make('backup.via_sftp')->options(self::$yesOrNo)->inline(true)->label(__('label.setting.backup.via_sftp'))->helperText(new HtmlString(__('label.setting.backup.via_sftp_help'))),
            ])->columns(2);

        $tabs[] = Forms\Components\Tabs\Tab::make(__('label.setting.seed_box.tab_header'))
            ->id('seed_box')
            ->schema([
                Forms\Components\Radio::make('seed_box.enabled')->options(self::$yesOrNo)->inline(true)->label(__('label.enabled'))->helperText(__('label.setting.seed_box.enabled_help')),
                Forms\Components\TextInput::make('seed_box.not_seed_box_max_speed')->label(__('label.setting.seed_box.not_seed_box_max_speed'))->helperText(__('label.setting.seed_box.not_seed_box_max_speed_help'))->integer(),
                Forms\Components\Radio::make('seed_box.no_promotion')->options(self::$yesOrNo)->inline(true)->label(__('label.setting.seed_box.no_promotion'))->helperText(__('label.setting.seed_box.no_promotion_help')),
                Forms\Components\TextInput::make('seed_box.max_uploaded')->label(__('label.setting.seed_box.max_uploaded'))->helperText(__('label.setting.seed_box.max_uploaded_help'))->integer(),
                Forms\Components\TextInput::make('seed_box.max_uploaded_duration')->label(__('label.setting.seed_box.max_uploaded_duration'))->helperText(__('label.setting.seed_box.max_uploaded_duration_help'))->integer(),
            ])->columns(2);

        $id = "meilisearch";
        $tabs[] = Forms\Components\Tabs\Tab::make(__("label.setting.$id.tab_header"))
            ->id($id)
            ->schema($this->getTabMeilisearchSchema($id))
            ->columns(2)
        ;

        $id = "image_hosting";
        $tabs[] = Forms\Components\Tabs\Tab::make(__("label.setting.$id.tab_header"))
            ->id($id)
            ->schema($this->getTabImageHostingSchema($id))
            ->columns(2)
        ;
        $id = "permission";
        $tabs[] = Forms\Components\Tabs\Tab::make(__("label.setting.$id.tab_header"))
            ->id($id)
            ->schema($this->getTabPermissionSchema($id))
            ->columns(2)
        ;

        $tabs[] = Forms\Components\Tabs\Tab::make(__('label.setting.system.tab_header'))
            ->id('system')
            ->schema([
                Forms\Components\Radio::make('system.change_username_card_allow_characters_outside_the_alphabets')
                    ->options(self::$yesOrNo)
                    ->inline(true)
                    ->label(__('label.setting.system.change_username_card_allow_characters_outside_the_alphabets'))
                ,
                Forms\Components\TextInput::make('system.change_username_min_interval_in_days')
                    ->integer()
                    ->label(__('label.setting.system.change_username_min_interval_in_days'))
                ,
                Forms\Components\TextInput::make('system.maximum_number_of_medals_can_be_worn')
                    ->integer()
                    ->label(__('label.setting.system.maximum_number_of_medals_can_be_worn'))
                ,
                Forms\Components\TextInput::make('system.cookie_valid_days')
                    ->integer()
                    ->label(__('label.setting.system.cookie_valid_days'))
                ,
                Forms\Components\TextInput::make('system.maximum_upload_speed')
                    ->integer()
                    ->label(__('label.setting.system.maximum_upload_speed'))
                    ->helperText(__('label.setting.system.maximum_upload_speed_help'))
                ,
                Forms\Components\Radio::make('system.is_invite_pre_email_and_username')
                    ->options(self::$yesOrNo)
                    ->inline(true)
                    ->label(__('label.setting.system.is_invite_pre_email_and_username'))
                    ->helperText(__('label.setting.system.is_invite_pre_email_and_username_help'))
                ,
                Forms\Components\Radio::make('system.is_record_announce_log')
                    ->options(self::$yesOrNo)
                    ->inline(true)
                    ->label(__('label.setting.system.is_record_announce_log'))
                    ->helperText(__('label.setting.system.is_record_announce_log_help'))
                ,
                Forms\Components\Radio::make('system.is_record_seeding_bonus_log')
                    ->options(self::$yesOrNo)
                    ->inline(true)
                    ->label(__('label.setting.system.is_record_seeding_bonus_log'))
                    ->helperText(__('label.setting.system.is_record_seeding_bonus_log_help'))
                ,
                Forms\Components\Select::make('system.access_admin_class_min')
                    ->options(User::listClass(User::CLASS_VIP))
                    ->label(__('label.setting.system.access_admin_class_min'))
                    ->helperText(__('label.setting.system.access_admin_class_min_help'))
                ,
                Forms\Components\TextInput::make('system.alarm_email_receiver')
                    ->label(__('label.setting.system.alarm_email_receiver'))
                    ->helperText(__('label.setting.system.alarm_email_receiver_help'))
                ,
            ])->columns(2);

        $tabs = apply_filter('nexus_setting_tabs', $tabs);
        return $tabs;
    }

    private function getHitAndRunSchema()
    {
        $default = [
            Forms\Components\Radio::make('hr.mode')->options(HitAndRun::listModes(true))->inline(true)->label(__('label.setting.hr.mode')),
            Forms\Components\TextInput::make('hr.inspect_time')->helperText(__('label.setting.hr.inspect_time_help'))->label(__('label.setting.hr.inspect_time'))->integer(),
            Forms\Components\TextInput::make('hr.seed_time_minimum')->helperText(__('label.setting.hr.seed_time_minimum_help'))->label(__('label.setting.hr.seed_time_minimum'))->integer(),
            Forms\Components\TextInput::make('hr.leech_time_minimum')->helperText(__('label.setting.hr.leech_time_minimum_help'))->label(__('label.setting.hr.leech_time_minimum'))->integer(),
            Forms\Components\TextInput::make('hr.ignore_when_ratio_reach')->helperText(__('label.setting.hr.ignore_when_ratio_reach_help'))->label(__('label.setting.hr.ignore_when_ratio_reach'))->integer(),
            Forms\Components\TextInput::make('hr.ban_user_when_counts_reach')->helperText(__('label.setting.hr.ban_user_when_counts_reach_help'))->label(__('label.setting.hr.ban_user_when_counts_reach'))->integer(),
            Forms\Components\TextInput::make('hr.include_rate')->helperText(__('label.setting.hr.include_rate_help'))->label(__('label.setting.hr.include_rate'))->numeric(),
        ];
        return apply_filter("hit_and_run_setting_schema", $default);
    }

    private function getRequireSeedSectionSchema(): array
    {
        return [
            Forms\Components\Radio::make('require_seed_section.enabled')->options(self::$yesOrNo)->label(__('label.enabled'))->helperText(__('label.setting.require_seed_section.enabled_help')),
            Forms\Components\TextInput::make('require_seed_section.menu_title')->label(__('label.setting.require_seed_section.menu_title'))->helperText(__('label.setting.require_seed_section.menu_title_help')),
            Forms\Components\TextInput::make('require_seed_section.seeder_lte')->label(__('label.setting.require_seed_section.seeder_lte'))->helperText(__('label.setting.require_seed_section.seeder_lte_help'))->integer(),
            Forms\Components\TextInput::make('require_seed_section.seeder_gte')->label(__('label.setting.require_seed_section.seeder_gte'))->helperText(__('label.setting.require_seed_section.seeder_gte_help'))->integer(),
            Forms\Components\CheckboxList::make('require_seed_section.require_tags')->label(__('label.setting.require_seed_section.require_tags'))->helperText(__('label.setting.require_seed_section.require_tags_help'))->options(Tag::query()->pluck('name', 'id'))->columns(4),
            Forms\Components\Select::make('require_seed_section.promotion_state')->label(__('label.setting.require_seed_section.promotion_state'))->helperText(__('label.setting.require_seed_section.promotion_state_help'))->options(Torrent::listPromotionTypes(true)),
            Forms\Components\TextInput::make('require_seed_section.daily_seed_time_min')->label(__('label.setting.require_seed_section.daily_seed_time_min'))->helperText(__('label.setting.require_seed_section.daily_seed_time_min_help'))->integer(),
            Forms\Components\TextInput::make('require_seed_section.torrent_count_max')->label(__('label.setting.require_seed_section.torrent_count_max'))->helperText(__('label.setting.require_seed_section.torrent_count_max_help'))->integer(),
            Forms\Components\Repeater::make('require_seed_section.bonus_reward')
                ->label(__('label.setting.require_seed_section.bonus_reward'))
                ->helperText(__('label.setting.require_seed_section.bonus_reward_help'))
                ->schema([
                    Forms\Components\TextInput::make('seeders')
                        ->label(__('label.setting.require_seed_section.seeders'))
                        ->required()
                        ->integer()
                        ->columnSpan(2)
                    ,
                    Forms\Components\Repeater::make('seed_time_reward')
                        ->label(__('label.setting.require_seed_section.seed_time_reward'))
                        ->schema([
                            Forms\Components\TextInput::make('begin')->label(__('label.setting.require_seed_section.seed_time_reward_begin'))->helperText(__('label.setting.require_seed_section.seed_time_reward_begin_help')),
                            Forms\Components\TextInput::make('end')->label(__('label.setting.require_seed_section.seed_time_reward_end'))->helperText(__('label.setting.require_seed_section.seed_time_reward_end_help')),
                            Forms\Components\TextInput::make('window')->label(__('label.setting.require_seed_section.seed_time_reward_window'))->helperText(__('label.setting.require_seed_section.seed_time_reward_window_help')),
                            Forms\Components\TextInput::make('reward')->label(__('label.setting.require_seed_section.seed_time_reward_reward'))->helperText(__('label.setting.require_seed_section.seed_time_reward_reward_help')),
                        ])
                        ->columns(4)
                        ->columnSpan(5)
                    ,
                    Forms\Components\Repeater::make('data_traffic_reward')
                        ->label(__('label.setting.require_seed_section.data_traffic_reward'))
                        ->schema([
                            Forms\Components\TextInput::make('begin')->label(__('label.setting.require_seed_section.data_traffic_reward_begin'))->helperText(__('label.setting.require_seed_section.data_traffic_reward_begin_help')),
                            Forms\Components\TextInput::make('end')->label(__('label.setting.require_seed_section.data_traffic_reward_end'))->helperText(__('label.setting.require_seed_section.data_traffic_reward_end_help')),
                            Forms\Components\TextInput::make('window')->label(__('label.setting.require_seed_section.data_traffic_reward_window'))->helperText(__('label.setting.require_seed_section.data_traffic_reward_window_help')),
                            Forms\Components\TextInput::make('reward')->label(__('label.setting.require_seed_section.data_traffic_reward_reward'))->helperText(__('label.setting.require_seed_section.data_traffic_reward_reward_help')),
                        ])
                        ->columns(4)
                        ->columnSpan(5)
                ])
                ->columns(12)
                ->columnSpanFull()
                ->defaultItems(3)
                ->reorderable(false)
        ];
    }

    private function getTabMeilisearchSchema($id): array
    {
        $schema = [];

        $name = "$id.enabled";
        $schema[] = Forms\Components\Radio::make($name)
            ->options(self::$yesOrNo)
            ->inline(true)
            ->label(__('label.enabled'))
            ->helperText(__("label.setting.{$name}_help"))
        ;

        $name = "$id.search_description";
        $schema[] = Forms\Components\Radio::make($name)
            ->options(self::$yesOrNo)
            ->inline(true)
            ->label(__("label.setting.$name"))
            ->helperText(__("label.setting.{$name}_help"))
        ;

        $name = "$id.default_search_mode";
        $schema[] = Forms\Components\Radio::make($name)
            ->options(SearchBox::listSearchModes())
            ->inline(true)
            ->label(__("label.setting.$name"))
            ->helperText(__("label.setting.{$name}_help"))
        ;

        return $schema;
    }

    private function getTabImageHostingSchema($id): array
    {
        $schema = [];
        $name = "$id.driver";
        $schema[] = Forms\Components\Radio::make($name)
            ->options(['local' => 'local', 'chevereto' => 'chevereto', 'lsky' => 'lsky'])
            ->inline(true)
            ->label(__("label.setting.$name"))
            ->helperText(__("label.setting.{$name}_help"))
            ->columnSpanFull()
        ;

        //chevereto
        $driverName = "chevereto";
        $driverId = sprintf("%s_%s", $id, $driverName);
        $driverSchemas = [];
        $field = "upload_api_endpoint";
        $driverSchemas[] = Forms\Components\TextInput::make("$driverId.$field")
            ->label(__("label.setting.$id.$field"))
        ;
        $field = "upload_token";
        $driverSchemas[] = Forms\Components\TextInput::make("$driverId.$field")
            ->label(__("label.setting.$id.$field"))
        ;
        $field = "base_url";
        $driverSchemas[] = Forms\Components\TextInput::make("$driverId.$field")
            ->label(__("label.setting.$id.$field"))
        ;

        $driverSection = Forms\Components\Section::make($driverName)->schema($driverSchemas);
        $schema[] = $driverSection;

        //lsky
        $driverName = "lsky";
        $driverId = sprintf("%s_%s", $id, $driverName);
        $driverSchemas = [];
        $field = "upload_api_endpoint";
        $driverSchemas[] = Forms\Components\TextInput::make("$driverId.$field")
            ->label(__("label.setting.$id.$field"))
        ;
        $field = "upload_token";
        $driverSchemas[] = Forms\Components\TextInput::make("$driverId.$field")
            ->label(__("label.setting.$id.$field"))
        ;
        $field = "base_url";
        $driverSchemas[] = Forms\Components\TextInput::make("$driverId.$field")
            ->label(__("label.setting.$id.$field"))
        ;
        $driverSection = Forms\Components\Section::make($driverName)->schema($driverSchemas);
        $schema[] = $driverSection;


        return $schema;
    }

    private function getTabPermissionSchema($id): array
    {
        $schema = [];

        $name = "$id.user_token_allowed";
        $schema[] = Forms\Components\CheckboxList::make($name)
            ->options(TokenRepository::listUserTokenPermissions())
            ->label(__("label.setting.{$name}"))
            ->helperText(__("label.setting.{$name}_help"))
            ->columns(2)
        ;


        return $schema;
    }

}
