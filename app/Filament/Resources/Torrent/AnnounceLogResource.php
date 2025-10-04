<?php

namespace App\Filament\Resources\Torrent;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Actions\ViewAction;
use App\Filament\Resources\Torrent\AnnounceLogResource\Pages\ListAnnounceLogs;
use App\Filament\Resources\Torrent\AnnounceLogResource\Pages;
use App\Filament\Resources\Torrent\AnnounceLogResource\RelationManagers;
use App\Models\AnnounceLog;
use App\Models\Setting;
use App\Models\Torrent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists;


class AnnounceLogResource extends Resource
{
    protected static ?string $model = AnnounceLog::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Tracker';

    protected static ?int $navigationSort = 5;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.announce_logs');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    /**
     * @return bool
     */
    public static function shouldRegisterNavigation(): bool
    {
        return Setting::getIsRecordAnnounceLog() && config('clickhouse.connection.host') != '';
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make(__('announce-log.tab_primary'))
                            ->schema([
                                Fieldset::make(__('announce-log.fieldset_basic'))
                                    ->schema([
                                        TextEntry::make('timestamp')->label(__('announce-log.timestamp')),
                                        TextEntry::make('user_id')->label(__('announce-log.user_id'))->copyable(),
                                        TextEntry::make('torrent_id')->label(__('announce-log.torrent_id'))->copyable(),
                                        TextEntry::make('torrent_size')->label(__('announce-log.torrent_size'))->formatStateUsing(fn($state) => mksize($state)),
                                        TextEntry::make('seeder_count')->label(__('announce-log.seeder_count')),
                                        TextEntry::make('leecher_count')->label(__('announce-log.leecher_count')),
                                        TextEntry::make('promotion_state')->label(__('announce-log.promotion_state'))->formatStateUsing(fn($state) => Torrent::$promotionTypes[$state]['text'] ?? ''),
                                        TextEntry::make('promotion_state_desc')->label(__('announce-log.promotion_state_desc')),
                                        TextEntry::make('event')->label(__('announce-log.event')),
                                        TextEntry::make('left')->label(__('announce-log.left'))->formatStateUsing(fn($state) => mksize($state)),
                                        TextEntry::make('announce_time')->label(__('announce-log.announce_time')),
                                        TextEntry::make('speed')->label(__('announce-log.speed'))->formatStateUsing(fn($state) => mksize($state) . "/s"),
                                    ])->columns(4),

                                Fieldset::make(__('announce-log.fieldset_uploaded'))
                                    ->schema([
                                        TextEntry::make('uploaded_offset')->label(__('announce-log.uploaded_offset'))->formatStateUsing(fn($state) => mksize($state)),
                                        TextEntry::make('uploaded_total_last')->label(__('announce-log.uploaded_total_last'))->formatStateUsing(fn($state) => mksize($state)),
                                        TextEntry::make('uploaded_total')->label(__('announce-log.uploaded_total'))->formatStateUsing(fn($state) => mksize($state)),
                                        TextEntry::make('uploaded_increment')->label(__('announce-log.uploaded_increment'))->formatStateUsing(fn($state) => mksize($state)),
                                        TextEntry::make('up_factor')->label(__('announce-log.up_factor')),
                                        TextEntry::make('up_factor_desc')->label(__('announce-log.up_factor_desc')),
                                        TextEntry::make('uploaded_increment_for_user')->label(__('announce-log.uploaded_increment_for_user'))->formatStateUsing(fn($state) => mksize($state)),
                                    ])->columns(4),

                                Fieldset::make(__('announce-log.fieldset_downloaded'))
                                    ->schema([
                                        TextEntry::make('downloaded_offset')->label(__('announce-log.downloaded_offset'))->formatStateUsing(fn($state) => mksize($state)),
                                        TextEntry::make('downloaded_total_last')->label(__('announce-log.downloaded_total_last'))->formatStateUsing(fn($state) => mksize($state)),
                                        TextEntry::make('downloaded_total')->label(__('announce-log.downloaded_total'))->formatStateUsing(fn($state) => mksize($state)),
                                        TextEntry::make('downloaded_increment')->label(__('announce-log.downloaded_increment'))->formatStateUsing(fn($state) => mksize($state)),
                                        TextEntry::make('down_factor')->label(__('announce-log.down_factor')),
                                        TextEntry::make('down_factor_desc')->label(__('announce-log.down_factor_desc')),
                                        TextEntry::make('downloaded_increment_for_user')->label(__('announce-log.downloaded_increment_for_user'))->formatStateUsing(fn($state) => mksize($state)),
                                    ])->columns(4),
                            ]),
                        Tab::make(__('announce-log.tab_secondary'))
                            ->schema([
                                Fieldset::make(__('announce-log.fieldset_client'))
                                    ->schema([
                                        TextEntry::make('port')->label(__('announce-log.port')),
                                        TextEntry::make('agent')->label(__('announce-log.agent')),
                                        TextEntry::make('peer_id')->label(__('announce-log.peer_id'))->copyable(),
                                        TextEntry::make('client_select')->label(__('announce-log.client_select')),
                                    ])->columns(4),
                                Fieldset::make(__('announce-log.fieldset_location'))
                                    ->schema([
                                        TextEntry::make('ip')->label(__('announce-log.ip'))->copyable()->limit(25),
                                        TextEntry::make('ipv4')->label(__('announce-log.ipv4'))->copyable(),
                                        TextEntry::make('ipv6')->label(__('announce-log.ipv6'))->copyable()->limit(25),
                                        TextEntry::make('continent')->label(__('announce-log.continent')),
                                        TextEntry::make('country')->label(__('announce-log.country')),
                                        TextEntry::make('city')->label(__('announce-log.city')),

                                    ])->columns(4),
                                Fieldset::make(__('announce-log.fieldset_request'))
                                    ->schema([
                                        TextEntry::make('scheme')->label(__('announce-log.scheme')),
                                        TextEntry::make('host')->label(__('announce-log.host')),
                                        TextEntry::make('path')->label(__('announce-log.path')),
                                        TextEntry::make('request_id')->label(__('announce-log.request_id'))->copyable()->limit(25),
                                        TextEntry::make('batch_no')->label(__('announce-log.batch_no'))->copyable(),

                                    ])->columns(4),
                            ]),
                    ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('timestamp')->label(__('announce-log.timestamp'))->sortable(),
                TextColumn::make('user_id')->label(__('announce-log.user_id')),
                TextColumn::make('torrent_id')->label(__('announce-log.torrent_id')),
                TextColumn::make('peer_id')->label(__('announce-log.peer_id')),
                TextColumn::make('torrent_size')
                    ->label(__('announce-log.torrent_size'))
                    ->formatStateUsing(fn ($state): string => mksize($state))
                ,
                TextColumn::make('uploaded_total')
                    ->label(__('announce-log.uploaded_total'))
                    ->formatStateUsing(fn ($state): string => mksize($state))
                    ->sortable()
                ,
                TextColumn::make('uploaded_increment')
                    ->label(__('announce-log.uploaded_increment'))
                    ->formatStateUsing(fn ($state): string => mksize($state))
                    ->sortable()
                ,
                TextColumn::make('downloaded_total')
                    ->label(__('announce-log.downloaded_total'))
                    ->formatStateUsing(fn ($state): string => mksize($state))
                    ->sortable()
                ,
                TextColumn::make('downloaded_increment')
                    ->label(__('announce-log.downloaded_increment'))
                    ->formatStateUsing(fn ($state): string => mksize($state))
                    ->sortable()
                ,
                TextColumn::make('left')
                    ->label(__('announce-log.left'))
                    ->formatStateUsing(fn ($state): string => mksize($state))
                    ->sortable()
                ,
                TextColumn::make('announce_time')
                    ->label(__('announce-log.announce_time'))
                    ->sortable()
                ,
                TextColumn::make('event')->label(__('announce-log.event')),
                TextColumn::make('ip')->label('IP'),
//                Tables\Columns\TextColumn::make('agent')->label(__('announce-log.agent')),
            ])
            ->filters([
                Filter::make('user_id')
                    ->schema([
                        TextInput::make('user_id')
                            ->label(__('announce-log.user_id'))
                            ->numeric()
                            ->minValue(1)
                        ,
                    ])
                ,
                Filter::make('torrent_id')
                    ->schema([
                        TextInput::make('torrent_id')
                            ->label(__('announce-log.torrent_id'))
                            ->numeric()
                            ->minValue(1)
                        ,
                    ])
                ,
                Filter::make('peer_id')
                    ->schema([
                        TextInput::make('peer_id')
                            ->label(__('announce-log.peer_id'))
                        ,
                    ])
                ,
                Filter::make('ip')
                    ->schema([
                        TextInput::make('ip')
                            ->label('IP')
                        ,
                    ])
                ,
                Filter::make('event')
                    ->schema([
                        Select::make('event')
                            ->label(__('announce-log.event'))
                            ->options(AnnounceLog::listEvents())
                        ,
                    ])
                ,
            ])
            ->recordActions([
                ViewAction::make()->modalWidth('5xl'),
            ])
            ->toolbarActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
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
            'index' => ListAnnounceLogs::route('/'),
//            'create' => Pages\CreateAnnounceLog::route('/create'),
//            'edit' => Pages\EditAnnounceLog::route('/{record}/edit'),
        ];
    }
}
