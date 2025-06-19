<?php

namespace App\Filament\Resources\System;

use App\Enums\MessageTemplateNameEnum;
use App\Filament\Resources\System\MessageTemplateResource\Pages;
use App\Filament\Resources\System\MessageTemplateResource\RelationManagers;
use App\Models\Language;
use App\Models\MessageTemplate;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class MessageTemplateResource extends Resource
{
    protected static ?string $model = MessageTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'System';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.message_templates');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Form $form): Form
    {
        $languages = Language::all();
        $default = $languages->first(fn ($item) => $item->site_lang_folder == Setting::getDefaultLang());
        return $form
            ->schema([
                Forms\Components\Select::make('name')
                    ->label(__('label.name'))
                    ->options(MessageTemplate::listAllNames())
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\Select::make('language_id')
                    ->label(__('label.language'))
                    ->options($languages->pluck('lang_name', 'id'))
                    ->default($default ? $default->id : null)
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\Textarea::make('content')
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
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('label.name'))
                    ->formatStateUsing(fn ($state) => $state->label())
                ,
                Tables\Columns\TextColumn::make('language.lang_name')
                    ->label(__('label.language'))
                ,
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('label.updated_at'))
                ,
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('name')
                    ->label(__('label.name'))
                    ->options(MessageTemplate::listAllNames())
                ,
                Tables\Filters\SelectFilter::make('language_id')
                    ->label(__('label.language'))
                    ->options(Language::all()->pluck('lang_name', 'id'))
                ,
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
            'index' => Pages\ManageMessageTemplates::route('/'),
        ];
    }
}
