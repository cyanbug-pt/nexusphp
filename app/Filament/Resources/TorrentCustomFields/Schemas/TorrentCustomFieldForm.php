<?php

namespace App\Filament\Resources\TorrentCustomFields\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Nexus\Field\Field;

class TorrentCustomFieldForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('label.field.name'))
                    ->helperText(__('label.field.name_help'))
                    ->alphaDash()
                    ->required(),
                TextInput::make('label')
                    ->label(__('label.field.field_label'))
                    ->required(),
                Select::make('type')
                    ->options((new Field())->getTypeRadioOptions())
                    ->label(__('label.field.type'))
                    ->required(),
                Checkbox::make('required')
                    ->label(__('label.field.required')),
                Textarea::make('help')
                    ->label(__('label.field.help'))
                    ->rows(3),
                Textarea::make('options')
                    ->label(__('label.field.options'))
                    ->rows(3)
                    ->hiddenJs("\$get('type') !== 'radio' && \$get('type') !== 'checkbox' && \$get('type') !== 'select'")
                    ->helperText(__('label.field.options_help')),
                Checkbox::make('is_single_row')
                    ->label(__('label.field.is_single_row')),
                TextInput::make('priority')
                    ->label(__('label.priority'))
                    ->numeric(),
                Textarea::make('display')
                    ->label(__('label.field.display'))
                    ->rows(3)
                    ->helperText(__('label.search_box.custom_fields_display_help')),

            ])
            ->columns(1);
    }
}
