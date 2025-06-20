<?php

namespace App\Filament\Resources\System;

use App\Filament\OptionsTrait;
use App\Filament\Resources\System\TrackerUrlResource\Pages;
use App\Filament\Resources\System\TrackerUrlResource\RelationManagers;
use App\Models\TrackerUrl;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrackerUrlResource extends Resource
{
    use OptionsTrait;

    protected static ?string $model = TrackerUrl::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'System';

    protected static ?int $navigationSort = 10;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.tracker_url');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('url')->required(),
                Forms\Components\Radio::make('is_default')
                    ->label(__('label.is_default'))
                    ->options(self::getYesNoOptions())
                    ->required(true)
                    ->inline()
                ,
                Forms\Components\Radio::make('enabled')
                    ->label(__('label.enabled'))
                    ->options(self::getEnableDisableOptions(1, 0))
                    ->required(true)
                    ->inline()
                ,
                Forms\Components\TextInput::make('priority')
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
                Tables\Columns\TextColumn::make('id')
                ,
                Tables\Columns\TextColumn::make('url')
                ,
                Tables\Columns\IconColumn::make('is_default')
                    ->label(__('label.is_default'))
                    ->boolean()
                ,
                Tables\Columns\IconColumn::make('enabled')
                    ->label(__('label.enabled'))
                    ->boolean()
                ,
                Tables\Columns\TextColumn::make('priority')
                    ->label(__('label.priority'))
                ,
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('label.updated_at'))
                ,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTrackerUrls::route('/'),
        ];
    }
}
