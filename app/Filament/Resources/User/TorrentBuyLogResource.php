<?php

namespace App\Filament\Resources\User;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\User\TorrentBuyLogResource\Pages\ListTorrentBuyLogs;
use App\Filament\Resources\User\TorrentBuyLogResource\Pages\CreateTorrentBuyLog;
use App\Filament\Resources\User\TorrentBuyLogResource\Pages\EditTorrentBuyLog;
use App\Filament\Resources\User\TorrentBuyLogResource\Pages;
use App\Filament\Resources\User\TorrentBuyLogResource\RelationManagers;
use App\Models\TorrentBuyLog;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TorrentBuyLogResource extends Resource
{
    protected static ?string $model = TorrentBuyLog::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'User';

    protected static ?int $navigationSort = 10;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.torrent_buy_log');
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('uid')
                    ->formatStateUsing(fn ($state) => username_for_admin($state))
                    ->label(__('label.username'))
                ,
                TextColumn::make('torrent_id')
                    ->formatStateUsing(fn ($record) => torrent_name_for_admin($record->torrent))
                    ->label(__('label.torrent.label'))
                ,
                TextColumn::make('price')
                    ->formatStateUsing(fn ($state) => number_format($state))
                    ->label(__('label.price'))
                ,
                TextColumn::make('created_at')
                    ->formatStateUsing(fn ($state) => format_datetime($state))
                    ->label(__('label.created_at'))
                ,
            ])
            ->defaultSort('id','desc')
            ->filters([
                Filter::make('uid')
                    ->schema([
                        TextInput::make('uid')
                            ->label(__('label.username'))
                            ->placeholder('UID')
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['uid'], fn (Builder $query, $value) => $query->where("uid", $value));
                    })
                ,
                Filter::make('torrent_id')
                    ->schema([
                        TextInput::make('torrent_id')
                            ->label(__('label.torrent.label'))
                            ->placeholder('Torrent ID')
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['torrent_id'], fn (Builder $query, $value) => $query->where("torrent_id", $value));
                    })
                ,
            ])
            ->recordActions([
//                Tables\Actions\EditAction::make(),
            ])
            ->toolbarActions([
//                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => ListTorrentBuyLogs::route('/'),
            'create' => CreateTorrentBuyLog::route('/create'),
            'edit' => EditTorrentBuyLog::route('/{record}/edit'),
        ];
    }
}
