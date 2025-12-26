<?php

namespace App\Filament\Resources\System;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\System\PluginResource\Pages\ManagePlugins;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use App\Filament\Resources\System\PluginResource\Pages;
use App\Filament\Resources\System\PluginResource\RelationManagers;
use App\Jobs\ManagePlugin;
use App\Models\Plugin;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class PluginResource extends Resource
{
    protected static ?string $model = Plugin::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-plus-circle';

    protected static string | \UnitEnum | null $navigationGroup = 'System';

    protected static ?int $navigationSort = 99;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.plugin');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('package_name')->label(__('plugin.labels.package_name')),
                TextInput::make('remote_url')->label(__('plugin.labels.remote_url')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('package_name')->label(__('plugin.labels.package_name')),
                TextColumn::make('remote_url')->label(__('plugin.labels.remote_url')),
                TextColumn::make('installed_version')->label(__('plugin.labels.installed_version')),
                TextColumn::make('statusText')->label(__('label.status')),
                TextColumn::make('updated_at')->label(__('plugin.labels.updated_at')),
            ])
            ->filters([
                //
            ])
            ->recordActions(self::getActions())
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePlugins::route('/'),
        ];
    }

    private static function getActions()
    {
        $actions = [];
        $actions[] = EditAction::make();
        $actions[] = self::buildInstallAction();
        $actions[] = self::buildUpdateAction();
        $actions[] = DeleteAction::make('delete')
            ->hidden(fn ($record) => !in_array($record->status, Plugin::$showDeleteBtnStatus))
            ->using(function ($record) {
                $record->update(['status' => Plugin::STATUS_PRE_DELETE]);
                ManagePlugin::dispatch($record, 'delete');
            });
        return $actions;
    }

    private static function buildInstallAction()
    {
        return Action::make('install')
            ->label(__('plugin.actions.install'))
            ->icon('heroicon-o-arrow-down')
            ->requiresConfirmation()
            ->hidden(fn ($record) => !in_array($record->status, Plugin::$showInstallBtnStatus))
            ->action(function ($record) {
                $record->update(['status' => Plugin::STATUS_PRE_INSTALL]);
                ManagePlugin::dispatch($record, 'install');
            })
        ;
    }

    private static function buildUpdateAction()
    {
        return Action::make('update')
            ->label(__('plugin.actions.update'))
            ->icon('heroicon-o-arrow-up')
            ->requiresConfirmation()
            ->hidden(fn ($record) => !in_array($record->status, Plugin::$showUpdateBtnStatus))
            ->action(function ($record) {
                $record->update(['status' => Plugin::STATUS_PRE_UPDATE]);
                ManagePlugin::dispatch($record, 'update');
            })
        ;
    }

}
