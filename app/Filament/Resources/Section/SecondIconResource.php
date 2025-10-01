<?php

namespace App\Filament\Resources\Section;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Section\SecondIconResource\Pages\ListSecondIcons;
use App\Filament\Resources\Section\SecondIconResource\Pages\CreateSecondIcon;
use App\Filament\Resources\Section\SecondIconResource\Pages\EditSecondIcon;
use App\Filament\Resources\Section\SecondIconResource\Pages;
use App\Filament\Resources\Section\SecondIconResource\RelationManagers;
use App\Models\SearchBox;
use App\Models\SecondIcon;
use App\Models\Setting;
use App\Repositories\SearchBoxRepository;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Nexus\Database\NexusDB;

class SecondIconResource extends Resource
{
    protected static ?string $model = SecondIcon::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-ticket';

    protected static string | \UnitEnum | null $navigationGroup = 'Section';

    protected static ?int $navigationSort = 11;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.second_icon');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Schema $schema): Schema
    {
        $searchBoxRep = new SearchBoxRepository();
        $torrentMode = Setting::get('main.browsecat');
        $specialMode = Setting::get('main.specialcat');
        $torrentTaxonomySchema = $searchBoxRep->listTaxonomyFormSchema($torrentMode);
        $specialTaxonomySchema = $searchBoxRep->listTaxonomyFormSchema($specialMode);
        $modeOptions = SearchBox::listModeOptions();
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('label.name'))
                    ->required()
                    ->helperText(__('label.second_icon.name_help'))
                ,
                TextInput::make('image')
                    ->label(__('label.second_icon.image'))
                    ->required()
                    ->helperText(__('label.second_icon.image_help'))
                ,
                TextInput::make('class_name')
                    ->label(__('label.second_icon.class_name'))
                    ->helperText(__('label.second_icon.class_name_help'))
                ,
                Select::make('mode')
                    ->options($modeOptions)
                    ->label(__('label.search_box.taxonomy.mode'))
                    ->helperText(__('label.search_box.taxonomy.mode_help'))
                    ->reactive()
                ,
                Section::make(__('label.second_icon.select_section'))
                    ->id("taxonomy_$torrentMode")
                    ->schema($torrentTaxonomySchema)
                    ->columns(4)
                    ->hidden(fn (Get $get) => $get('mode') != $torrentMode)
                ,
                Section::make(__('label.second_icon.select_section'))
                    ->id("taxonomy_$specialMode")
                    ->schema($specialTaxonomySchema)
                    ->columns(4)
                    ->hidden(fn (Get $get) => $get('mode') != $specialMode)
                ,

            ]);
    }



    public static function table(Table $table): Table
    {
        $columns = [
            TextColumn::make('id'),
            TextColumn::make('search_box.name')
                ->label(__('label.search_box.label'))
                ->formatStateUsing(fn ($record) => $record->search_box->name ?? 'All')
            ,
            TextColumn::make('name')->label(__('label.name')),
            TextColumn::make('image')->label(__('label.second_icon.image')),
            TextColumn::make('class_name')->label(__('label.second_icon.class_name')),
        ];
        $taxonomyList = self::listTaxonomy();
        foreach (SearchBox::$taxonomies as $torrentField => $taxonomyTableModel) {
            $columns[] = TextColumn::make($torrentField)->formatStateUsing(function ($state) use ($taxonomyList, $torrentField) {
                 return $taxonomyList[$torrentField]->get($state);
            });
        }
        return $table
            ->columns($columns)
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

    private static function listTaxonomy()
    {
        static $taxonomyList = [];
        if (empty($taxonomyList)) {
            foreach (SearchBox::$taxonomies as $torrentField => $taxonomyTableModel) {
                $taxonomyList[$torrentField] = NexusDB::table($taxonomyTableModel['table'])->pluck('name', 'id');
            }
        }
        return $taxonomyList;
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
            'index' => ListSecondIcons::route('/'),
            'create' => CreateSecondIcon::route('/create'),
            'edit' => EditSecondIcon::route('/{record}/edit'),
        ];
    }
}
