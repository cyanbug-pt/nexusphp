<?php

namespace App\Filament\Resources\Torrent;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Torrent\TorrentDenyReasonResource\Pages\ManageTorrentDenyReasons;
use App\Filament\Resources\Torrent\TorrentDenyReasonResource\Pages;
use App\Filament\Resources\Torrent\TorrentDenyReasonResource\RelationManagers;
use App\Models\TorrentDenyReason;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TorrentDenyReasonResource extends Resource
{
    protected static ?string $model = TorrentDenyReason::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-no-symbol';

    protected static string | \UnitEnum | null $navigationGroup = 'Torrent';

    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.torrent_deny_reason');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required()->label(__('label.name')),
                TextInput::make('priority')->integer()->label(__('label.priority'))->default(0),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name')->label(__('label.name')),
                TextColumn::make('priority')->label(__('label.priority'))->sortable(),
                TextColumn::make('created_at')->label(__('label.created_at')),
            ])
            ->defaultSort('priority', 'desc')
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
            'index' => ManageTorrentDenyReasons::route('/'),
        ];
    }
}
