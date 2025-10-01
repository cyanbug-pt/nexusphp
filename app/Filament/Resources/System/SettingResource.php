<?php

namespace App\Filament\Resources\System;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use App\Filament\Resources\System\SettingResource\Pages\EditSetting;
use App\Filament\OptionsTrait;
use App\Filament\Resources\System\SettingResource\Pages;
use App\Filament\Resources\System\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    use OptionsTrait;

    protected static ?string $model = Setting::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog';

    protected static string | \UnitEnum | null $navigationGroup = 'System';

    protected static ?int $navigationSort = 1000;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.settings');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required()->disabled()->columnSpan(['sm' => 2]),
                Textarea::make('value')->required()->columnSpan(['sm' => 2])
                    ->afterStateHydrated(function (Textarea $component, $state) {
                        $arr = json_decode($state, true);
                        if (is_array($arr)) {
                            $component->disabled();
                        }
                    })
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name')->searchable(),
                TextColumn::make('value')->limit(),
                BadgeColumn::make('autoload')->colors(['success' => 'yes', 'warning' => 'no']),
                TextColumn::make('updated_at'),
            ])
            ->filters([
                SelectFilter::make('autoload')->options(self::$yesOrNo),
            ])
            ->recordActions([
                EditAction::make(),
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
//            'index' => Pages\ListSettings::route('/'),
//            'create' => Pages\CreateSetting::route('/create'),
            'index' => EditSetting::route('/'),
        ];
    }
}
