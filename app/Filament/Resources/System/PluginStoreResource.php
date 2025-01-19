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
use Illuminate\Support\HtmlString;
use Filament\Actions\Action;
use Livewire\Livewire;

class PluginStoreResource extends Resource
{

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'System';

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
                        Tables\Columns\TextColumn::make('title')
                            ->weight(FontWeight::Bold)
                        ,
                        Tables\Columns\TextColumn::make('description'),
                    ]),
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('version')
                            ->formatStateUsing(fn (PluginStore $record) => sprintf("版本: %s | 更新时间: %s", $record->version, $record->release_date))
                            ->color('gray')
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
                    ->modalHeading("详细介绍")
                    ->modalContent(fn (PluginStore $record) => $record->getFullDescription())
                    ->extraModalFooterActions([
                        Action::make("viewOnBlog")
                            ->url(fn (PluginStore $record) => $record->getBlogPostUrl())
                            ->extraAttributes(['target' => '_blank'])
                        ,
                    ])
                ,
                Tables\Actions\Action::make("install")
                    ->label("安装")
                    ->modalHeading(fn (PluginStore $record) => sprintf("安装插件: %s", $record->title))
                    ->modalContent(function (PluginStore $record) {
                        $infolist = new Infolist();
                        $infolist->record = $record;
                        $infolist->schema([
                            Infolists\Components\TextEntry::make('plugin_id')
                                ->label(fn () => sprintf("进入目录: %s, 以 root 用户的身份依次执行以下命令进行安装: ", base_path()))
                                ->html(true)
                                ->formatStateUsing(function (PluginStore $record) {
                                    return self::getPluginInstruction($record);
                                })
                            ,
                        ]);
                        return $infolist;
                    })
                    ->modalFooterActions(fn () => [])
                ,
            ])
            ->recordAction(null)
            ->paginated(false)
        ;
    }

    private static function getPluginInstruction(PluginStore $record): string
    {
        $result = [];
        $result[] = "配置扩展地址";
        $result[] = sprintf("<code>composer config repositories.%s git %s</code>", $record->plugin_id, $record->remote_url);
        $result[] = "<br/>下载扩展. 这里展示的最新版本号, 如果需要安装其他版本(可在查看页面底部获得)自行替换";
        $result[] = sprintf("<code>composer require %s:%s</code>", $record->package_name, $record->version);
        $result[] = "<br/>执行安装";
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
