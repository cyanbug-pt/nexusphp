<?php

namespace App\Filament\Pages;

use App\Filament\Resources\System\IpLogs\IpLogResource;
use App\Models\IpLog;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use BackedEnum;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\HtmlString;
use UnitEnum;
class IpSearch extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.ip-search';

    protected Width | string | null $maxContentWidth = 'full';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?int $navigationSort = 3;

    protected static string|null|UnitEnum $navigationGroup = 'System';

    public function getTitle(): string|Htmlable
    {
        return __('ip-search.label');
    }

    public static function getNavigationLabel(): string
    {
        return __('ip-search.label');
    }

    public static function canAccess(): bool
    {
        return Gate::allows('viewAny', IpLog::class);
    }

    public function table(Table $table): Table
    {
        return $table
            ->records(fn (array $filters, int $page, int $recordsPerPage): LengthAwarePaginator => self::getRecords($filters, $page, $recordsPerPage))
            ->columns([
                TextColumn::make('userid')
                    ->label(__('label.username'))
                    ->state(fn (array $record) => username_for_admin($record['userid']))
                ,
                TextColumn::make('last_access_ip')
                    ->label(__('ip-search.last_access_ip'))
                ,
                TextColumn::make('last_access')
                    ->label(__('ip-search.last_access'))
                ,
                TextColumn::make('ip_count')
                    ->label(__('ip-search.ip_count'))
                    ->state(function (array $record) {
                        return new HtmlString(sprintf(
                            '<a href="%s" target="_blank"><b>%s</b></a>',
                            IpLogResource::getUrl('index', ['filters[uid][uid]' => $record['userid']]), $record['ip_count']
                        ));
                    })
                ,
                TextColumn::make('ip_last_access')
                    ->label(__('ip-search.ip_last_access'))
                ,
                TextColumn::make('user_added')
                    ->label(__('ip-search.user_added'))
                ,
                TextColumn::make('invited_by')
                    ->state(fn (array $record) => $record['invited_by'] > 0 ? username_for_admin($record['invited_by']) : '')
                    ->label(__('ip-search.invited_by'))
                ,
            ])
            ->filters([
                Filter::make('ip')
                    ->schema([
                        TextInput::make('ip')
                            ->label(__('ip-search.label'))
                            ->placeholder(__('ip-search.placeholder'))
                        ,
                    ])
            ])
            ->recordActions([
//                ViewAction::make(),
//                EditAction::make(),
//                DeleteAction::make(),
            ])
//            ->toolbarActions([
//                BulkActionGroup::make([
////                    DeleteBulkAction::make(),
//                ]),
//            ]);
            ;
    }

    private static function getRecords(array $filters, int $page, int $recordsPerPage): LengthAwarePaginator
    {
        $total = 0;
        $results = [];
        if (!empty($filters['ip']['ip'])) {
            $query = DB::table('iplog')
                ->leftJoin('users', 'users.id', '=', 'iplog.userid')
                ->select([
                    'iplog.userid',
                    'users.username',
                    'users.last_access',
                    DB::raw('users.added as user_added'),
                    'users.invited_by',
                    'users.ip AS last_access_ip',
                    DB::raw('MAX(iplog.access) AS ip_last_access'),
                    DB::raw('0 AS ip_count'),
                ])
                ->whereRaw("iplog.ip = '{$filters['ip']['ip']}'")
            ;
            $total = $query->clone()->distinct()->count('iplog.userid');
            $records = $query->groupBy('iplog.userid')
                ->orderByDesc('ip_last_access')
                ->forPage($page, $recordsPerPage)
                ->get()
            ;

            if ($records->isNotEmpty()) {
                $userIdArr = $records->pluck('userid')->toArray();
                $ipCountResult = IpLog::query()
                    ->whereIn('userid', $userIdArr)
                    ->selectRaw('userid, COUNT(distinct ip) AS count')
                    ->groupBy('userid')
                    ->get()
                    ->pluck('count', 'userid')
                    ->toArray();
                ;
                foreach ($records as $record) {
                    $item = json_decode(json_encode($record), true);
                    $item['ip_count'] = $ipCountResult[$item['userid']] ?? 0;
                    $results[] = $item;
                }
            }
        }
        return new LengthAwarePaginator(
            $results,
            total: $total,
            perPage: $recordsPerPage,
            currentPage: $page,
        );
    }
}
