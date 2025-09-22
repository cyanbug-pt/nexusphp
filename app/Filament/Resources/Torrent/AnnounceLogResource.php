<?php

namespace App\Filament\Resources\Torrent;

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
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\Fieldset;


class AnnounceLogResource extends Resource
{
    protected static ?string $model = AnnounceLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Torrent';

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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make(__('announce-log.tab_primary'))
                            ->schema([
                                Fieldset::make(__('announce-log.fieldset_basic'))
                                    ->schema([
                                        Infolists\Components\TextEntry::make('timestamp')->label(__('announce-log.timestamp')),
                                        Infolists\Components\TextEntry::make('user_id')->label(__('announce-log.user_id'))->copyable(),
                                        Infolists\Components\TextEntry::make('torrent_id')->label(__('announce-log.torrent_id'))->copyable(),
                                        Infolists\Components\TextEntry::make('torrent_size')->label(__('announce-log.torrent_size'))->formatStateUsing(fn($state) => mksize($state)),
                                        Infolists\Components\TextEntry::make('seeder_count')->label(__('announce-log.seeder_count')),
                                        Infolists\Components\TextEntry::make('leecher_count')->label(__('announce-log.leecher_count')),
                                        Infolists\Components\TextEntry::make('promotion_state')->label(__('announce-log.promotion_state'))->formatStateUsing(fn($state) => Torrent::$promotionTypes[$state]['text'] ?? ''),
                                        Infolists\Components\TextEntry::make('promotion_state_desc')->label(__('announce-log.promotion_state_desc')),
                                        Infolists\Components\TextEntry::make('event')->label(__('announce-log.event')),
                                        Infolists\Components\TextEntry::make('left')->label(__('announce-log.left'))->formatStateUsing(fn($state) => mksize($state)),
                                        Infolists\Components\TextEntry::make('announce_time')->label(__('announce-log.announce_time')),
                                        Infolists\Components\TextEntry::make('speed')->label(__('announce-log.speed'))->formatStateUsing(fn($state) => mksize($state) . "/s"),
                                    ])->columns(4),

                                Fieldset::make(__('announce-log.fieldset_uploaded'))
                                    ->schema([
                                        Infolists\Components\TextEntry::make('uploaded_offset')->label(__('announce-log.uploaded_offset'))->formatStateUsing(fn($state) => mksize($state)),
                                        Infolists\Components\TextEntry::make('uploaded_total_last')->label(__('announce-log.uploaded_total_last'))->formatStateUsing(fn($state) => mksize($state)),
                                        Infolists\Components\TextEntry::make('uploaded_total')->label(__('announce-log.uploaded_total'))->formatStateUsing(fn($state) => mksize($state)),
                                        Infolists\Components\TextEntry::make('uploaded_increment')->label(__('announce-log.uploaded_increment'))->formatStateUsing(fn($state) => mksize($state)),
                                        Infolists\Components\TextEntry::make('up_factor')->label(__('announce-log.up_factor')),
                                        Infolists\Components\TextEntry::make('up_factor_desc')->label(__('announce-log.up_factor_desc')),
                                        Infolists\Components\TextEntry::make('uploaded_increment_for_user')->label(__('announce-log.uploaded_increment_for_user'))->formatStateUsing(fn($state) => mksize($state)),
                                    ])->columns(4),

                                Fieldset::make(__('announce-log.fieldset_downloaded'))
                                    ->schema([
                                        Infolists\Components\TextEntry::make('downloaded_offset')->label(__('announce-log.downloaded_offset'))->formatStateUsing(fn($state) => mksize($state)),
                                        Infolists\Components\TextEntry::make('downloaded_total_last')->label(__('announce-log.downloaded_total_last'))->formatStateUsing(fn($state) => mksize($state)),
                                        Infolists\Components\TextEntry::make('downloaded_total')->label(__('announce-log.downloaded_total'))->formatStateUsing(fn($state) => mksize($state)),
                                        Infolists\Components\TextEntry::make('downloaded_increment')->label(__('announce-log.downloaded_increment'))->formatStateUsing(fn($state) => mksize($state)),
                                        Infolists\Components\TextEntry::make('down_factor')->label(__('announce-log.down_factor')),
                                        Infolists\Components\TextEntry::make('down_factor_desc')->label(__('announce-log.down_factor_desc')),
                                        Infolists\Components\TextEntry::make('downloaded_increment_for_user')->label(__('announce-log.downloaded_increment_for_user'))->formatStateUsing(fn($state) => mksize($state)),
                                    ])->columns(4),
                            ]),
                        Tabs\Tab::make(__('announce-log.tab_secondary'))
                            ->schema([
                                Fieldset::make(__('announce-log.fieldset_client'))
                                    ->schema([
                                        Infolists\Components\TextEntry::make('port')->label(__('announce-log.port')),
                                        Infolists\Components\TextEntry::make('agent')->label(__('announce-log.agent')),
                                        Infolists\Components\TextEntry::make('peer_id')->label(__('announce-log.peer_id'))->copyable(),
                                        Infolists\Components\TextEntry::make('client_select')->label(__('announce-log.client_select')),
                                    ])->columns(4),
                                Fieldset::make(__('announce-log.fieldset_location'))
                                    ->schema([
                                        Infolists\Components\TextEntry::make('ip')->label(__('announce-log.ip'))->copyable()->limit(25),
                                        Infolists\Components\TextEntry::make('ipv4')->label(__('announce-log.ipv4'))->copyable(),
                                        Infolists\Components\TextEntry::make('ipv6')->label(__('announce-log.ipv6'))->copyable()->limit(25),
                                        Infolists\Components\TextEntry::make('continent')->label(__('announce-log.continent')),
                                        Infolists\Components\TextEntry::make('country')->label(__('announce-log.country')),
                                        Infolists\Components\TextEntry::make('city')->label(__('announce-log.city')),

                                    ])->columns(4),
                                Fieldset::make(__('announce-log.fieldset_request'))
                                    ->schema([
                                        Infolists\Components\TextEntry::make('scheme')->label(__('announce-log.scheme')),
                                        Infolists\Components\TextEntry::make('host')->label(__('announce-log.host')),
                                        Infolists\Components\TextEntry::make('path')->label(__('announce-log.path')),
                                        Infolists\Components\TextEntry::make('request_id')->label(__('announce-log.request_id'))->copyable()->limit(25),
                                        Infolists\Components\TextEntry::make('batch_no')->label(__('announce-log.batch_no'))->copyable(),

                                    ])->columns(4),
                            ]),
                    ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('timestamp')->label(__('announce-log.timestamp'))->sortable(),
                Tables\Columns\TextColumn::make('user_id')->label(__('announce-log.user_id')),
                Tables\Columns\TextColumn::make('torrent_id')->label(__('announce-log.torrent_id')),
                Tables\Columns\TextColumn::make('peer_id')->label(__('announce-log.peer_id')),
                Tables\Columns\TextColumn::make('torrent_size')
                    ->label(__('announce-log.torrent_size'))
                    ->formatStateUsing(fn ($state): string => mksize($state))
                ,
                Tables\Columns\TextColumn::make('uploaded_total')
                    ->label(__('announce-log.uploaded_total'))
                    ->formatStateUsing(fn ($state): string => mksize($state))
                    ->sortable()
                ,
                Tables\Columns\TextColumn::make('uploaded_increment')
                    ->label(__('announce-log.uploaded_increment'))
                    ->formatStateUsing(fn ($state): string => mksize($state))
                    ->sortable()
                ,
                Tables\Columns\TextColumn::make('downloaded_total')
                    ->label(__('announce-log.downloaded_total'))
                    ->formatStateUsing(fn ($state): string => mksize($state))
                    ->sortable()
                ,
                Tables\Columns\TextColumn::make('downloaded_increment')
                    ->label(__('announce-log.downloaded_increment'))
                    ->formatStateUsing(fn ($state): string => mksize($state))
                    ->sortable()
                ,
                Tables\Columns\TextColumn::make('left')
                    ->label(__('announce-log.left'))
                    ->formatStateUsing(fn ($state): string => mksize($state))
                    ->sortable()
                ,
                Tables\Columns\TextColumn::make('announce_time')
                    ->label(__('announce-log.announce_time'))
                    ->sortable()
                ,
                Tables\Columns\TextColumn::make('event')->label(__('announce-log.event')),
                Tables\Columns\TextColumn::make('ip')->label('IP'),
//                Tables\Columns\TextColumn::make('agent')->label(__('announce-log.agent')),
            ])
            ->filters([
                Tables\Filters\Filter::make('user_id')
                    ->form([
                        Forms\Components\TextInput::make('user_id')
                            ->label(__('announce-log.user_id'))
                            ->numeric()
                            ->minValue(1)
                        ,
                    ])
                ,
                Tables\Filters\Filter::make('torrent_id')
                    ->form([
                        Forms\Components\TextInput::make('torrent_id')
                            ->label(__('announce-log.torrent_id'))
                            ->numeric()
                            ->minValue(1)
                        ,
                    ])
                ,
                Tables\Filters\Filter::make('peer_id')
                    ->form([
                        Forms\Components\TextInput::make('peer_id')
                            ->label(__('announce-log.peer_id'))
                        ,
                    ])
                ,
                Tables\Filters\Filter::make('ip')
                    ->form([
                        Forms\Components\TextInput::make('ip')
                            ->label('IP')
                        ,
                    ])
                ,
                Tables\Filters\Filter::make('event')
                    ->form([
                        Forms\Components\Select::make('event')
                            ->label(__('announce-log.event'))
                            ->options(AnnounceLog::listEvents())
                        ,
                    ])
                ,
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->modalWidth('5xl'),
            ])
            ->bulkActions([
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
            'index' => Pages\ListAnnounceLogs::route('/'),
//            'create' => Pages\CreateAnnounceLog::route('/create'),
//            'edit' => Pages\EditAnnounceLog::route('/{record}/edit'),
        ];
    }
}
