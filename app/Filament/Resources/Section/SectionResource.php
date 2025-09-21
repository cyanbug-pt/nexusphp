<?php

namespace App\Filament\Resources\Section;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Closure;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Section\SectionResource\Pages\ListSections;
use App\Filament\Resources\Section\SectionResource\Pages\CreateSection;
use App\Filament\Resources\Section\SectionResource\Pages\EditSection;
use App\Filament\Resources\Section\SectionResource\Pages;
use App\Filament\Resources\Section\SectionResource\RelationManagers;
use App\Http\Middleware\Locale;
use App\Models\Forum;
use App\Models\SearchBox;
use App\Models\TorrentCustomField;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;

class SectionResource extends Resource
{
    protected static ?string $model = SearchBox::class;

    protected static ?string $slug = 'sections';

    protected static ?string $pluralModelLabel = 'Section';

    protected static ?string $label = 'Section';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-view-columns';

    protected static string | \UnitEnum | null $navigationGroup = 'Section';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.section');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    private static function buildLocalSchema($name)
    {
        $localeSchema = [];
        foreach (Locale::$languageMaps as $lang => $locale) {
            $localeSchema[] = TextInput::make("$name.$lang")->required()->label($lang);
        }
        return $localeSchema;
    }

    public static function form(Schema $schema): Schema
    {
        $displayTextLocalSchema = self::buildLocalSchema('display_text');
        $sectionNameLocalSchema = self::buildLocalSchema('section_name');
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('label.search_box.name'))
                    ->rules(function ($record) {
                        return [
                            'required',
                            'alpha_dash:ascii',
                            Rule::unique('searchbox', 'name')->ignore($record?->id)
                        ];
                    })
                ,
                TextInput::make('catsperrow')
                    ->label(__('label.search_box.catsperrow'))
                    ->helperText(__('label.search_box.catsperrow_help'))
                    ->integer()
                    ->required()
                    ->default(8)
                ,
                TextInput::make('catpadding')
                    ->label(__('label.search_box.catpadding'))
                    ->helperText(__('label.search_box.catpadding_help'))
                    ->integer()
                    ->required()
                    ->default(3)
                ,
                CheckboxList::make('custom_fields')
                    ->options(TorrentCustomField::getCheckboxOptions())
                    ->label(__('label.search_box.custom_fields'))
                    ->columns(4)
                ,
                TextInput::make('custom_fields_display_name')
                    ->label(__('label.search_box.custom_fields_display_name'))
                ,
                Textarea::make('custom_fields_display')
                    ->label(__('label.search_box.custom_fields_display'))
                    ->helperText(__('label.search_box.custom_fields_display_help'))
                ,
                CheckboxList::make('other')
                    ->options(SearchBox::listExtraText())
                    ->columns(2)
                    ->label(__('label.search_box.other'))
                ,

                Section::make(__('label.search_box.section_name'))
                    ->schema($sectionNameLocalSchema)
                    ->columns(count($sectionNameLocalSchema))
                ,
                Toggle::make('showsubcat')->label(__('label.search_box.showsubcat'))->columnSpan(['sm' => 'full']),
                Section::make(__('label.search_box.showsubcat'))->schema([
                    Repeater::make('extra.' . SearchBox::EXTRA_TAXONOMY_LABELS)
                        ->schema([
                            Select::make('torrent_field')->options(SearchBox::getSubCatOptions())->label(__('label.search_box.torrent_field')),
                            Section::make(__('label.search_box.taxonomy_display_text'))->schema($displayTextLocalSchema)->columns(count($displayTextLocalSchema)),
                        ])
                        ->label(__('label.search_box.taxonomies'))
                        ->rules([
                            function () {
                                return function (string $attribute, $value, Closure $fail) {
                                    $fields = [];
                                    foreach ($value as $item) {
                                        if (!in_array($item['torrent_field'], $fields)) {
                                            $fields[] = $item['torrent_field'];
                                        } else {
                                            $fail(__('label.search_box.torrent_field_duplicate', ['field' => $item['torrent_field']]));
                                        }
                                    }
                                };
                            }
                        ])
                    ,
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name')->label(__('label.search_box.name')),
                BooleanColumn::make('showsubcat')->label(__('label.search_box.showsubcat')),
                BooleanColumn::make('showsource'),
                BooleanColumn::make('showmedium'),
                BooleanColumn::make('showcodec'),
                BooleanColumn::make('showstandard'),
                BooleanColumn::make('showprocessing'),
                BooleanColumn::make('showteam'),
                BooleanColumn::make('showaudiocodec'),
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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSections::route('/'),
            'create' => CreateSection::route('/create'),
            'edit' => EditSection::route('/{record}/edit'),
        ];
    }
}
