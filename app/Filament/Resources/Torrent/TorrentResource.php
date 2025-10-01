<?php

namespace App\Filament\Resources\Torrent;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\BadgeColumn;
use App\Filament\Resources\Torrent\TorrentResource\Pages\ListTorrents;
use App\Filament\Resources\Torrent\TorrentResource\Pages\CreateTorrent;
use App\Filament\Resources\Torrent\TorrentResource\Pages\EditTorrent;
use Filament\Actions\BulkAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Exception;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Textarea;
use Filament\Actions\DeleteAction;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
use App\Filament\OptionsTrait;
use App\Filament\Resources\Torrent\TorrentResource\Pages;
use App\Filament\Resources\Torrent\TorrentResource\RelationManagers;
use App\Models\Category;
use App\Models\SearchBox;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\Torrent;
use App\Models\TorrentTag;
use App\Models\User;
use App\Repositories\SearchBoxRepository;
use App\Repositories\TagRepository;
use App\Repositories\TorrentRepository;
use Elasticsearch\Endpoints\Search;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Pages\Actions\Action;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Nexus\Database\NexusDB;

class TorrentResource extends Resource
{
    use OptionsTrait;

    protected static ?string $model = Torrent::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Torrent';

    protected static ?int $navigationSort = 1;

    private static ?TorrentRepository $rep;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.torrent_list');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }

    public static function getRep(): ?TorrentRepository
    {
        if (self::$rep === null) {
            self::$rep = new TorrentRepository();
        }
        return self::$rep;
    }

    public static function table(Table $table): Table
    {
        $showApproval = self::shouldShowApproval();
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('basic_category.name')->label(__('label.torrent.category')),
                TextColumn::make('name')->formatStateUsing(fn ($record) => torrent_name_for_admin($record, true))
                    ->label(__('label.name'))
                    ->searchable(query: function (Builder $query, string $search) {
                        return $query->where("name", "like", "%{$search}%")->orWhere("small_descr", "like", "%{$search}%");
                    }),
                TextColumn::make('posStateText')->label(__('label.torrent.pos_state')),
                TextColumn::make('spStateText')->label(__('label.torrent.sp_state')),
                TextColumn::make('pickInfoText')
                    ->label(__('label.torrent.picktype'))
                    ->formatStateUsing(fn ($record) => $record->pickInfo['text'])
                ,
                IconColumn::make('hr')
                    ->label(__('label.torrent.hr'))
                    ->boolean()
                ,
                TextColumn::make('size')
                    ->label(__('label.torrent.size'))
                    ->formatStateUsing(fn ($state) => mksize($state))
                    ->sortable()
                ,
                TextColumn::make('seeders')->label(__('label.torrent.seeders'))->sortable(),
                TextColumn::make('leechers')->label(__('label.torrent.leechers'))->sortable(),
                BadgeColumn::make('approval_status')
                    ->visible($showApproval)
                    ->label(__('label.torrent.approval_status'))
                    ->colors(array_flip(Torrent::listApprovalStatus(true, 'badge_color')))
                    ->formatStateUsing(fn ($record) => $record->approvalStatusText),
                TextColumn::make('added')->label(__('label.added'))->dateTime(),
                TextColumn::make('user.username')
                    ->label(__('label.torrent.owner'))
                    ->formatStateUsing(fn ($record) => username_for_admin($record->owner))
                ,
            ])
            ->defaultSort('id', 'desc')
            ->filters(self::getFilters())
            ->recordActions(self::getActions())
            ->toolbarActions(self::getBulkActions())
        ;

    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['user', 'basic_category', 'tags']);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTorrents::route('/'),
            'create' => CreateTorrent::route('/create'),
            'edit' => EditTorrent::route('/{record}/edit'),
        ];
    }

    private static function getBulkActions(): array
    {
        $user = Auth::user();
        $actions = [];
        if (user_can('torrentsticky')) {
            $actions[] = BulkAction::make('posState')
                ->label(__('admin.resources.torrent.bulk_action_pos_state'))
                ->form([
                    Select::make('pos_state')
                        ->label(__('label.torrent.pos_state'))
                        ->options(Torrent::listPosStates(true))
                        ->required()
                    ,
                    DateTimePicker::make('pos_state_until')
                        ->label(__('label.deadline'))
                    ,
                ])
                ->icon('heroicon-o-arrow-up-circle')
                ->action(function (Collection $records, array $data) {
                    $idArr = $records->pluck('id')->toArray();
                    try {
                        $torrentRep = new TorrentRepository();
                        $torrentRep->setPosState($idArr, $data['pos_state'], $data['pos_state_until']);
                    } catch (Exception $exception) {
                        do_log($exception->getMessage() . $exception->getTraceAsString(), 'error');
                        Filament::notify('danger', class_basename($exception));
                    }
                })
                ->deselectRecordsAfterCompletion();
        }

        if (user_can('torrentonpromotion')) {
            $actions[] = BulkAction::make('sp_state')
                ->label(__('admin.resources.torrent.bulk_action_sp_state'))
                ->form([
                    Select::make('sp_state')
                        ->label(__('label.torrent.sp_state'))
                        ->options(Torrent::listPromotionTypes(true))
                        ->required()
                    ,
                    Select::make('promotion_time_type')
                        ->label(__('label.torrent.promotion_time_type'))
                        ->options(Torrent::listPromotionTimeTypes(true))
                        ->required()
                    ,
                    DateTimePicker::make('promotion_until')
                        ->label(__('label.deadline'))
                    ,
                ])
                ->icon('heroicon-o-megaphone')
                ->action(function (Collection $records, array $data) {
                    $idArr = $records->pluck('id')->toArray();
                    try {
                        $torrentRep = new TorrentRepository();
                        $torrentRep->setSpState($idArr, $data['sp_state'], $data['promotion_time_type'], $data['promotion_until']);
                    } catch (Exception $exception) {
                        do_log($exception->getMessage() . $exception->getTraceAsString(), 'error');
                        Filament::notify('danger', $exception->getMessage());
                    }
                })
                ->deselectRecordsAfterCompletion();
        }

        if (user_can('torrentmanage') && ($user->picker == 'yes' || $user->class >= User::CLASS_SYSOP)) {
            $actions[] = BulkAction::make('recommend')
                ->label(__('admin.resources.torrent.bulk_action_recommend'))
                ->form([
                    Radio::make('picktype')
                        ->label(__('admin.resources.torrent.bulk_action_recommend'))
                        ->inline()
                        ->options(Torrent::listPickInfo(true))
                        ->required(),

                ])
                ->icon('heroicon-o-fire')
                ->action(function (Collection $records, array $data) {
                    if (empty($data['picktype'])) {
                        return;
                    }
                    $idArr = $records->pluck('id')->toArray();
                    try {
                        $torrentRep = new TorrentRepository();
                        $torrentRep->setPickType($idArr, $data['picktype']);
                    } catch (Exception $exception) {
                        do_log($exception->getMessage() . $exception->getTraceAsString(), 'error');
                        Filament::notify('danger', class_basename($exception));
                    }
                })
                ->deselectRecordsAfterCompletion();
        }

        if (user_can('torrentmanage')) {
            $actions[] = BulkAction::make('remove_tag')
                ->label(__('admin.resources.torrent.bulk_action_remove_tag'))
                ->requiresConfirmation()
                ->icon('heroicon-o-minus-circle')
                ->action(function (Collection $records) {
                    $idArr = $records->pluck('id')->toArray();
                    try {
                        $torrentRep = new TorrentRepository();
                        $torrentRep->syncTags($idArr);
                    } catch (Exception $exception) {
                        do_log($exception->getMessage() . $exception->getTraceAsString(), 'error');
                        Filament::notify('danger', class_basename($exception));
                    }
                })
                ->deselectRecordsAfterCompletion();

            $actions[] = BulkAction::make('attach_tag')
                ->label(__('admin.resources.torrent.bulk_action_attach_tag'))
                ->form([
                    Checkbox::make('remove')->label(__('admin.resources.torrent.bulk_action_attach_tag_remove_old')),
                    CheckboxList::make('tags')
                        ->label(__('label.tag.label'))
                        ->columns(4)
                        ->options(TagRepository::createBasicQuery()->pluck('name', 'id')->toArray())
                        ->required(),

                ])
                ->icon('heroicon-o-tag')
                ->action(function (Collection $records, array $data) {
                    if (empty($data['tags'])) {
                        return;
                    }
                    $idArr = $records->pluck('id')->toArray();
                    try {
                        $torrentRep = new TorrentRepository();
                        $torrentRep->syncTags($idArr, $data['tags'], $data['remove'] ?? false);
                    } catch (Exception $exception) {
                        do_log($exception->getMessage() . $exception->getTraceAsString(), 'error');
                        Filament::notify('danger', class_basename($exception));
                    }
                })
                ->deselectRecordsAfterCompletion();

            $actions[] = BulkAction::make('hr')
                ->label(__('admin.resources.torrent.bulk_action_hr'))
                ->form([
                    Radio::make('hr')
                        ->label(__('admin.resources.torrent.bulk_action_hr'))
                        ->inline()
                        ->options(self::getYesNoOptions())
                        ->required(),

                ])
                ->icon('heroicon-o-sparkles')
                ->action(function (Collection $records, array $data) {
                    if (!isset($data['hr'])) {
                        return;
                    }
                    $idArr = $records->pluck('id')->toArray();
                    try {
                        $torrentRep = new TorrentRepository();
                        $torrentRep->setHr($idArr, $data['hr']);
                    } catch (Exception $exception) {
                        do_log($exception->getMessage() . $exception->getTraceAsString(), 'error');
                        Filament::notify('danger', class_basename($exception));
                    }
                })
                ->deselectRecordsAfterCompletion();
        }
//        $actions[] = self::getBulkActionChangeCategory();

        if (user_can('torrent-delete')) {
            $actions[] = DeleteBulkAction::make('bulk-delete')->using(function (Collection $records) {
                deletetorrent($records->pluck('id')->toArray());
            });
        }
        return $actions;
    }

    private static function getActions(): array
    {
        $actions = [];
        if (self::shouldShowApproval() && user_can('torrent-approval')) {
            $actions[] = \Filament\Actions\Action::make('approval')
                ->label(__('admin.resources.torrent.action_approval'))
                ->schema([
                    Radio::make('approval_status')
                        ->label(__('label.torrent.approval_status'))
                        ->inline()
                        ->required()
                        ->options(Torrent::listApprovalStatus(true))
                    ,
                    Textarea::make('comment')->label(__('label.comment')),
                ])
                ->action(function (Torrent $record, array $data) {
                    $torrentRep = new TorrentRepository();
                    try {
                        $data['torrent_id'] = $record->id;
                        $torrentRep->approval(Auth::user(), $data);
                    } catch (Exception $exception) {
                        do_log($exception->getMessage(), 'error');
                    }
                });

        }
        if (user_can('torrent-delete')) {
            $actions[] = DeleteAction::make('delete')->using(function ($record) {
                deletetorrent($record->id);
            });
        }
        return $actions;
    }

    private static function getBulkActionChangeCategory(): BulkAction
    {
        $searchBoxRep = new SearchBoxRepository();
        return BulkAction::make('changeCategory')
            ->label(__('admin.resources.torrent.bulk_action_change_category'))
            ->form([
                Select::make('section_id')
                    ->label(__('searchbox.section'))
                    ->helperText(new HtmlString(__('admin.resources.torrent.bulk_action_change_category_section_help')))
                    ->options(function() {
                        $rep = new SearchBoxRepository();
                        $list = $rep->listSections(SearchBox::listAllSectionId(), false);
                        $result = [];
                        foreach ($list as $section) {
                            $result[$section->id] = $section->displaySectionName;
                        }
                        return $result;
                    })
                    ->reactive()
                    ->required()
                ,
                $searchBoxRep->buildSearchBoxFormSchema(SearchBox::getBrowseSearchBox(), 'section_info')
                    ->hidden(function (Get $get) {
                        return $get('section_id') != SearchBox::getBrowseMode();
                    })
                ,
                $searchBoxRep->buildSearchBoxFormSchema(SearchBox::getSpecialSearchBox(), 'section_info')
                    ->hidden(function (Get $get) {
                        return $get('section_id') != SearchBox::getSpecialMode();
                    })
                ,

            ])
            ->action(function (Collection $records, array $data) {
                $torrentRep = new TorrentRepository();
                $newSectionId = $data['section_id'];
                try {
                    $torrentRep->changeCategory($records, $newSectionId, $data['section_info']['section'][$newSectionId]);
                } catch (Exception $exception) {
                    do_log($exception->getMessage(), 'error');
                }
            });
    }

    private static function shouldShowApproval(): bool
    {
        return false;
//        return Setting::get('torrent.approval_status_none_visible') == 'no' || Setting::get('torrent.approval_status_icon_enabled') == 'yes';
    }

    private static function getFilters()
    {
        $filters = [
            Filter::make('owner')
                ->schema([
                    TextInput::make('owner')
                        ->label(__('label.torrent.owner'))
                        ->placeholder('UID')
                    ,
                ])->query(function (Builder $query, array $data) {
                    return $query->when($data['owner'], fn (Builder $query, $owner) => $query->where("owner", $owner));
                })
            ,

            SelectFilter::make('visible')
                ->options(self::$yesOrNo)
                ->label(__('label.torrent.visible'))
            ,
            SelectFilter::make('hr')
                ->options(self::getYesNoOptions())
                ->label(__('label.torrent.hr'))
            ,

            SelectFilter::make('pos_state')
                ->options(Torrent::listPosStates(true))
                ->label(__('label.torrent.pos_state'))
                ->multiple()
            ,

            SelectFilter::make('sp_state')
                ->options(Torrent::listPromotionTypes(true))
                ->label(__('label.torrent.sp_state'))
                ->multiple()
            ,

            SelectFilter::make('picktype')
                ->options(Torrent::listPickInfo(true))
                ->label(__('label.torrent.picktype'))
                ->multiple()
            ,

            SelectFilter::make('approval_status')
                ->options(Torrent::listApprovalStatus(true))
                ->label(__('label.torrent.approval_status'))
                ->multiple()
            ,

            SelectFilter::make('tags')
                ->relationship('tags', 'name')
                ->label(__('label.tag.label'))
                ->multiple()
            ,
            SelectFilter::make('category')
                ->options(Category::query()->pluck('name', 'id')->toArray())
                ->label(__('label.torrent.category'))
                ->multiple()
            ,
        ];
        foreach (SearchBox::$taxonomies as $torrentField => $tableModel) {
            $filters[] = SelectFilter::make($torrentField)
                ->options(NexusDB::table($tableModel['table'])->orderBy('sort_index')->orderBy('id')->pluck('name', 'id'))
                ->multiple()
            ;
        }

        $filters[] = Filter::make('added_begin')
            ->schema([
                DatePicker::make('added_begin')
                    ->maxDate(now())
                    ->label(__('label.torrent.added_begin'))
                ,
            ])->query(function (Builder $query, array $data) {
                return $query->when($data['added_begin'], fn (Builder $query, $value) => $query->where("added", '>=', $value));
            })
        ;
        $filters[] = Filter::make('added_end')
            ->schema([
                DatePicker::make('added_end')
                    ->maxDate(now())
                    ->label(__('label.torrent.added_end'))
                ,
            ])->query(function (Builder $query, array $data) {
                return $query->when($data['added_end'], fn (Builder $query, $value) => $query->where("added", '<=', $value));
            })
        ;
        $filters[] = Filter::make('size_begin')
            ->schema([
                TextInput::make('size_begin')
                    ->numeric()
                    ->placeholder('GB')
                    ->label(__('label.torrent.size_begin'))
                ,
            ])->query(function (Builder $query, array $data) {
                return $query->when($data['size_begin'], fn (Builder $query, $value) => $query->where("size", '>=', $value * 1024 * 1024 * 1024));
            })
        ;
        $filters[] = Filter::make('size_end')
            ->schema([
                TextInput::make('size_end')
                    ->numeric()
                    ->placeholder('GB')
                    ->label(__('label.torrent.size_end'))
                ,
            ])->query(function (Builder $query, array $data) {
                return $query->when($data['size_end'], fn (Builder $query, $value) => $query->where("size", '<=', $value * 1024 * 1024 * 1024));
            })
        ;


        return $filters;

    }

}
