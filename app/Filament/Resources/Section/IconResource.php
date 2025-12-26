<?php

namespace App\Filament\Resources\Section;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Radio;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Section\IconResource\Pages\ListIcons;
use App\Filament\Resources\Section\IconResource\Pages\CreateIcon;
use App\Filament\Resources\Section\IconResource\Pages\EditIcon;
use App\Filament\OptionsTrait;
use App\Filament\EditRedirectIndexTrait;
use App\Filament\Resources\Section\IconResource\Pages;
use App\Filament\Resources\Section\IconResource\RelationManagers;
use App\Models\Icon;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IconResource extends Resource
{
    use OptionsTrait;

    protected static ?string $model = Icon::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-ticket';

    protected static string | \UnitEnum | null $navigationGroup = 'Section';

    protected static ?int $navigationSort = 10;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.icon');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('tip')
                    ->default(nexus_trans('label.icon.desc'))
                    ->disabled()
                    ->columnSpanFull()
                    ->rows(18)
                ,
                TextInput::make('name')
                    ->label(__('label.name'))
                    ->required()
                ,
                TextInput::make('folder')
                    ->label(__('label.icon.folder'))
                    ->required()
                    ->helperText(__('label.icon.folder_help'))
                ,
                Radio::make('multilang')
                    ->label(__('label.icon.multilang'))
                    ->options(self::$yesOrNo)
                    ->required()
                    ->helperText(__('label.icon.multilang_help'))
                ,
                Radio::make('secondicon')
                    ->label(__('label.icon.secondicon'))
                    ->options(self::$yesOrNo)
                    ->required()
                    ->helperText(__('label.icon.secondicon_help'))
                ,
                TextInput::make('cssfile')->label(__('label.icon.cssfile'))->helperText(__('label.icon.cssfile_help')),
                TextInput::make('designer')->label(__('label.icon.designer'))->helperText(__('label.icon.designer_help')),
                Textarea::make('comment')->label(__('label.icon.comment'))->helperText(__('label.icon.comment_help')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name')->label(__('label.name')),
                TextColumn::make('folder')->label(__('label.icon.folder')),
                TextColumn::make('multilang')->label(__('label.icon.multilang')),
                TextColumn::make('secondicon')->label(__('label.icon.secondicon')),
                TextColumn::make('cssfile')->label(__('label.icon.cssfile')),
                TextColumn::make('designer')->label(__('label.icon.designer')),
            ])
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIcons::route('/'),
            'create' => CreateIcon::route('/create'),
            'edit' => EditIcon::route('/{record}/edit'),
        ];
    }
}
