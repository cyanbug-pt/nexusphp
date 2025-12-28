<?php

namespace App\Filament\Resources\TorrentCustomFields\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TorrentCustomFieldsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name')->label(__('label.field.name')),
                TextColumn::make('label')->label(__('label.field.field_label')),
                TextColumn::make('type')->label(__('label.field.type')),
                IconColumn::make('required')->boolean()->label(__('label.field.required')),
                IconColumn::make('is_single_row')->boolean()->label(__('label.field.is_single_row')),
                TextColumn::make('priority')->label(__('label.priority')),
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
}
