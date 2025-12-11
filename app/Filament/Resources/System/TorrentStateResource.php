<?php

namespace App\Filament\Resources\System;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\System\TorrentStateResource\Pages\ManageTorrentStates;
use App\Models\Torrent;
use App\Models\TorrentState;
use Carbon\Carbon;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TorrentStateResource extends Resource
{
    protected static ?string $model = TorrentState::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-megaphone';

    protected static string | \UnitEnum | null $navigationGroup = 'System';

    protected static ?int $navigationSort = 9;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.torrent_state');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('global_sp_state')
                    ->options(function () {
                        $options = Torrent::listPromotionTypes(true);
                        unset($options[Torrent::PROMOTION_NORMAL]);
                        return $options;
                    })
                    ->label(__('label.torrent_state.global_sp_state'))
                    ->required(),
                DateTimePicker::make('begin')
                    ->label(__('label.begin'))
                    ->required(),
                DateTimePicker::make('deadline')
                    ->label(__('label.deadline'))
                    ->required()
                    ->after('begin')
                    ->validationMessages([
                        'after' => __('label.torrent_state.deadline_after_begin'),
                    ]),
                Select::make('notice_days')
                    ->label(__('label.torrent_state.notice_days'))
                    ->options(TorrentState::noticeOptions())
                    ->required()
                    ->default(TorrentState::NOTICE_NONE)
                    ->dehydrated(true)
                    ->native(false),
                Textarea::make('remark')
                    ->label(__('label.comment'))
                    ->rows(2)
                    ->columnSpanFull()
                    ->maxLength(255),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('global_sp_state_text')->label(__('label.torrent_state.global_sp_state')),
                TextColumn::make('begin')->label(__('label.begin')),
                TextColumn::make('deadline')->label(__('label.deadline')),
                TextColumn::make('promotion_status')
                    ->label(__('label.torrent_state.status'))
                    ->state(function (TorrentState $record) {
                        $now = Carbon::now();
                        $begin = $record->begin ? Carbon::parse($record->begin) : null;
                        $deadline = $record->deadline ? Carbon::parse($record->deadline) : null;

                        if ($deadline && $deadline->lt($now)) {
                            return 'expired';
                        }
                        if ($begin && $begin->gt($now)) {
                            return 'upcoming';
                        }
                        return 'ongoing';
                    })
                    ->formatStateUsing(function (string $state) {
                        return match ($state) {
                            'expired' => __('label.torrent_state.status_expired'),
                            'upcoming' => __('label.torrent_state.status_upcoming'),
                            default => __('label.torrent_state.status_ongoing'),
                        };
                    })
                    ->badge()
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        $now = Carbon::now()->toDateTimeString();
                        // expired=0, ongoing=1, upcoming=2
                        return $query->orderByRaw(
                            "CASE
                                WHEN deadline IS NOT NULL AND deadline < ? THEN 0
                                WHEN begin IS NOT NULL AND begin > ? THEN 2
                                ELSE 1
                            END {$direction}",
                            [$now, $now]
                        );
                    })
                    ->color(fn (string $state) => match ($state) {
                        'expired' => 'danger',
                        'upcoming' => 'info',
                        default => 'success',
                    })
                    ->icon(fn (string $state) => match ($state) {
                        'expired' => 'heroicon-o-x-circle',
                        'upcoming' => 'heroicon-o-clock',
                        default => 'heroicon-o-check-circle',
                    })
                    ->iconPosition('before'),
                TextColumn::make('notice_days_text')
                    ->label(__('label.torrent_state.notice_days')),
                TextColumn::make('remark')->label(__('label.comment'))->limit(50),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageTorrentStates::route('/'),
        ];
    }
}
