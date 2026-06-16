<?php

namespace App\Filament\Resources\TorrentCustomFields;

use App\Filament\Resources\TorrentCustomFields\Pages\ListTorrentCustomFields;
use App\Filament\Resources\TorrentCustomFields\Schemas\TorrentCustomFieldForm;
use App\Filament\Resources\TorrentCustomFields\Tables\TorrentCustomFieldsTable;
use App\Models\TorrentCustomField;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TorrentCustomFieldResource extends Resource
{
    protected static ?string $model = TorrentCustomField::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|null|UnitEnum $navigationGroup = 'Section';

    protected static ?int $navigationSort = 12;

    public static function getNavigationLabel(): string
    {
        return __('label.field.label');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Schema $schema): Schema
    {
        return TorrentCustomFieldForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TorrentCustomFieldsTable::configure($table);
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
            'index' => ListTorrentCustomFields::route('/'),
        ];
    }
}
