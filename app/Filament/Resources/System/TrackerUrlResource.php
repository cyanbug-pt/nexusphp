<?php

namespace App\Filament\Resources\System;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Radio;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\System\TrackerUrlResource\Pages\ManageTrackerUrls;
use App\Filament\OptionsTrait;
use App\Filament\Resources\System\TrackerUrlResource\Pages;
use App\Filament\Resources\System\TrackerUrlResource\RelationManagers;
use App\Models\TrackerUrl;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrackerUrlResource extends Resource
{
    use OptionsTrait;

    protected static ?string $model = TrackerUrl::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'System';

    protected static ?int $navigationSort = 10;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.tracker_url');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('url')->required(),
                Radio::make('is_default')
                    ->label(__('label.is_default'))
                    ->options(self::getYesNoOptions())
                    ->required(true)
                    ->inline()
                ,
                Radio::make('enabled')
                    ->label(__('label.enabled'))
                    ->options(self::getEnableDisableOptions(1, 0))
                    ->required(true)
                    ->inline()
                ,
                TextInput::make('priority')
                    ->label(__('label.priority'))->numeric()
                    ->default(0)
                    ->helperText(__('label.priority_help'))
                ,
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return TrackerUrl::query()
            ->orderBy('is_default', 'desc')
            ->orderBy('priority', 'desc')
            ->orderBy('id', 'desc')
            ;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ,
                TextColumn::make('url')
                ,
                IconColumn::make('is_default')
                    ->label(__('label.is_default'))
                    ->boolean()
                ,
                IconColumn::make('enabled')
                    ->label(__('label.enabled'))
                    ->boolean()
                ,
                TextColumn::make('priority')
                    ->label(__('label.priority'))
                ,
                TextColumn::make('updated_at')
                    ->label(__('label.updated_at'))
                ,
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageTrackerUrls::route('/'),
        ];
    }
}
