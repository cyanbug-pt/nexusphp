<?php

namespace App\Filament\Resources\System;

use App\Filament\Resources\System\PluginStoreResource\Pages;
use App\Filament\Resources\System\PluginStoreResource\RelationManagers;
use App\Livewire\InstallPluginModal;
use App\Models\Plugin;
use App\Models\PluginStore;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Components;
use Filament\Infolists;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\App;
use Illuminate\Support\HtmlString;
use Filament\Actions\Action;
use Livewire\Livewire;

class PluginStoreResource extends Resource
{

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'System';

    protected static ?int $navigationSort = 99;

    public static function getNavigationBadge(): ?string
    {
        return PluginStore::getHasNewVersionCount() ?: '';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make(self::getColumnLabelKey("title"))
                            ->weight(FontWeight::Bold)
                        ,
                        Tables\Columns\TextColumn::make(self::getColumnLabelKey("description")),
                    ]),
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('version')
                            ->formatStateUsing(function (PluginStore $record) {
                                $installedVersion = $record->installed_version;
                                $latestVersion = $record->version;
                                if ($installedVersion) {
                                    return sprintf('%s: %s', nexus_trans("plugin.labels.installed_version"), $installedVersion);
                                }
                                return sprintf(
                                    '%s: %s | %s: %s',
                                    nexus_trans("plugin.labels.latest_version"), $latestVersion,
                                    nexus_trans("plugin.labels.release_date"), $record->release_date
                                );
                            })
                            ->color(fn ($record) => $record->installed_version ? 'success' : 'gray')
                        ,
                    ])
                ])->space(3),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->modalHeading(nexus_trans("plugin.labels.introduce"))
                    ->modalContent(fn (PluginStore $record) => $record->getFullDescription())
                    ->extraModalFooterActions([
                        Action::make(nexus_trans("plugin.labels.view_on_blog"))
                            ->url(fn (PluginStore $record) => $record->getBlogPostUrl())
                            ->extraAttributes(['target' => '_blank'])
                        ,
                    ])
                ,
                Tables\Actions\Action::make("install")
                    ->label(function(PluginStore $record) {
                        if ($record->hasNewVersion()) {
                            return sprintf('%s(new: %s)', nexus_trans("plugin.actions.update"), $record->version);
                        }
                        return nexus_trans("plugin.actions.install");
                    })
                    ->modalHeading(fn (PluginStore $record) => sprintf("%s: %s", nexus_trans("plugin.actions.install_or_update"), data_get($record, self::getColumnLabelKey("title"))))
                    ->modalContent(function (PluginStore $record) {
                        $infolist = new Infolist();
                        $infolist->record = $record;
                        $infolist->schema([
                            Infolists\Components\TextEntry::make('plugin_id')
                                ->label(fn () => nexus_trans("plugin.labels.install_title", ['web_root' => base_path()]))
                                ->html(true)
                                ->formatStateUsing(function (PluginStore $record) {
                                    return self::getPluginInstruction($record);
                                })
                            ,
                        ]);
                        return $infolist;
                    })
                    ->modalFooterActions(fn () => [])
                    ->color(fn (PluginStore $record) => $record->hasNewVersion() ? 'danger' : 'primary')
                ,
            ])
            ->recordAction(null)
            ->paginated(false)
        ;
    }

    private static function getColumnLabelKey($column): string
    {
        $locale = App::getLocale();
        if (in_array($locale, ['zh_CN', 'zh_TW'])) {
            return "$column.zh_CN";
        }
        return "$column.en";
    }

    private static function getPluginInstruction(PluginStore $record): string
    {
        $result = [];
        $result[] = nexus_trans("plugin.labels.config_plugin_address");
        $result[] = sprintf("<code>composer config repositories.%s vcs %s</code>", $record->plugin_id, $record->remote_url);
        $result[] = "<br/>" . nexus_trans("plugin.labels.download_specific_version");
        $result[] = sprintf("<code>composer require %s:%s</code>", $record->package_name, $record->version);
        $result[] = "<br/>" . nexus_trans("plugin.labels.execute_install");
        $result[] = sprintf("<code>php artisan plugin install %s</code>", $record->package_name);
        return implode("<br/>", $result);
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
            'index' => Pages\ListPluginStores::route('/'),
//            'create' => Pages\CreatePluginStore::route('/create'),
//            'edit' => Pages\EditPluginStore::route('/{record}/edit'),
        ];
    }
}
