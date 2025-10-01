<?php

namespace App\Filament\Resources\Torrent;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\Torrent\TorrentOperationLogResource\Pages\ManageTorrentOperationLogs;
use App\Filament\Resources\Torrent\TorrentOperationLogResource\Pages;
use App\Filament\Resources\Torrent\TorrentOperationLogResource\RelationManagers;
use App\Models\Torrent;
use App\Models\TorrentOperationLog;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TorrentOperationLogResource extends Resource
{
    protected static ?string $model = TorrentOperationLog::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Torrent';

    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.torrent_operation_log');
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
                TextColumn::make('user.username')
                    ->formatStateUsing(fn ($record) => username_for_admin($record->uid))
                    ->label(__('label.user.label'))
                ,
                TextColumn::make('torrent.name')
                    ->formatStateUsing(fn ($record) => torrent_name_for_admin($record->torrent))
                    ->label(__('label.torrent.label'))
                ,
                TextColumn::make('action_type_text')
                    ->label(__('torrent-operation-log.fields.action_type'))
                ,
                TextColumn::make('comment')
                    ->label(__('label.comment'))
                ,

                TextColumn::make('created_at')
                    ->formatStateUsing(fn ($state) => format_datetime($state))
                    ->label(__('label.created_at'))
                ,
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Filter::make('uid')
                    ->schema([
                        TextInput::make('uid')
                            ->placeholder('UID')
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['uid'], fn (Builder $query, $value) => $query->where("uid", $value));
                    })
                ,
                Filter::make('torrent_id')
                    ->schema([
                        TextInput::make('torrent_id')
                            ->placeholder('Torrent ID')
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['torrent_id'], fn (Builder $query, $value) => $query->where("torrent_id", $value));
                    })
                ,
                SelectFilter::make('action_type')
                    ->options(TorrentOperationLog::listStaticProps(TorrentOperationLog::$actionTypes, 'torrent.operation_log.%s.type_text', true))
                    ->label(__('torrent-operation-log.fields.action_type'))
                    ->multiple()
                ,
            ])
            ->recordActions([
//                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
//                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageTorrentOperationLogs::route('/'),
        ];
    }
}
