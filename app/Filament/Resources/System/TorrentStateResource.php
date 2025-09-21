<?php

namespace App\Filament\Resources\System;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use App\Filament\Resources\System\TorrentStateResource\Pages\ManageTorrentStates;
use App\Filament\Resources\System\TorrentStateResource\Pages;
use App\Filament\Resources\System\TorrentStateResource\RelationManagers;
use App\Models\Setting;
use App\Models\Torrent;
use App\Models\TorrentState;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Nexus\Database\NexusDB;

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
                    ->options(Torrent::listPromotionTypes(true))
                    ->label(__('label.torrent_state.global_sp_state'))
                    ->required(),
                DateTimePicker::make('begin')
                    ->label(__('label.begin')),
                DateTimePicker::make('deadline')
                    ->label(__('label.deadline')),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('global_sp_state_text')->label(__('label.torrent_state.global_sp_state')),
                TextColumn::make('begin')->label(__('label.begin')),
                TextColumn::make('deadline')->label(__('label.deadline')),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()->after(function () {
                    do_log("cache_del: global_promotion_state");
                    NexusDB::cache_del(Setting::TORRENT_GLOBAL_STATE_CACHE_KEY);
                    do_log("publish_model_event: global_promotion_state_updated");
                    publish_model_event("global_promotion_state_updated", 0);
                }),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
//                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageTorrentStates::route('/'),
        ];
    }
}
