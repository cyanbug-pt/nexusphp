<?php

namespace App\Filament\Resources\System;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\System\MessageTemplateResource\Pages\ManageMessageTemplates;
use App\Enums\MessageTemplateNameEnum;
use App\Filament\Resources\System\MessageTemplateResource\Pages;
use App\Filament\Resources\System\MessageTemplateResource\RelationManagers;
use App\Models\Language;
use App\Models\MessageTemplate;
use App\Models\Setting;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class MessageTemplateResource extends Resource
{
    protected static ?string $model = MessageTemplate::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'System';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.message_templates');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Schema $schema): Schema
    {
        $languages = Language::all();
        $default = $languages->first(fn ($item) => $item->site_lang_folder == Setting::getDefaultLang());
        return $schema
            ->components([
                Select::make('name')
                    ->label(__('label.name'))
                    ->options(MessageTemplate::listAllNames())
                    ->columnSpanFull()
                    ->required(),
                Select::make('language_id')
                    ->label(__('label.language'))
                    ->options($languages->pluck('lang_name', 'id'))
                    ->default($default ? $default->id : null)
                    ->columnSpanFull()
                    ->required(),
                Textarea::make('content')
                    ->label(__('label.content'))
                    ->helperText(new HtmlString(__('message-template.content_help')."<br/>".__('message-template.register_welcome_content_help')))
                    ->columnSpanFull()
                    ->rows(10)
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name')
                    ->label(__('label.name'))
                    ->formatStateUsing(fn ($state) => $state->label())
                ,
                TextColumn::make('language.lang_name')
                    ->label(__('label.language'))
                ,
                TextColumn::make('updated_at')
                    ->label(__('label.updated_at'))
                ,
            ])
            ->filters([
                SelectFilter::make('name')
                    ->label(__('label.name'))
                    ->options(MessageTemplate::listAllNames())
                ,
                SelectFilter::make('language_id')
                    ->label(__('label.language'))
                    ->options(Language::all()->pluck('lang_name', 'id'))
                ,
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
            'index' => ManageMessageTemplates::route('/'),
        ];
    }
}
