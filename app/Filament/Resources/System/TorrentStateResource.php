<?php

namespace App\Filament\Resources\System;

use App\Filament\Resources\System\TorrentStateResource\Pages;
use App\Filament\Resources\System\TorrentStateResource\RelationManagers;
use App\Models\Setting;
use App\Models\Torrent;
use App\Models\TorrentState;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Nexus\Database\NexusDB;

class TorrentStateResource extends Resource
{
    protected static ?string $model = TorrentState::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $navigationGroup = 'System';

    protected static ?int $navigationSort = 99;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.torrent_state');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('global_sp_state')
                    ->options(Torrent::listPromotionTypes(true))
                    ->label(__('label.torrent_state.global_sp_state'))
                    ->required(),
                Forms\Components\DateTimePicker::make('begin')
                    ->label(__('label.begin')),
                Forms\Components\DateTimePicker::make('deadline')
                    ->label(__('label.deadline')),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('global_sp_state_text')->label(__('label.torrent_state.global_sp_state')),
                Tables\Columns\TextColumn::make('begin')->label(__('label.begin')),
                Tables\Columns\TextColumn::make('deadline')->label(__('label.deadline')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->after(function () {
                    do_log("cache_del: global_promotion_state");
                    NexusDB::cache_del(Setting::TORRENT_GLOBAL_STATE_CACHE_KEY);
                    do_log("publish_model_event: global_promotion_state_updated");
                    publish_model_event("global_promotion_state_updated", 0);
                }),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTorrentStates::route('/'),
        ];
    }
}
