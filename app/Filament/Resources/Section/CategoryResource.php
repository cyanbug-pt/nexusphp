<?php

namespace App\Filament\Resources\Section;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Exception;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Section\CategoryResource\Pages\ListCategories;
use App\Filament\Resources\Section\CategoryResource\Pages\CreateCategory;
use App\Filament\Resources\Section\CategoryResource\Pages\EditCategory;
use App\Filament\Resources\Section\CategoryResource\Pages;
use App\Filament\Resources\Section\CategoryResource\RelationManagers;
use App\Models\Category;
use App\Models\Icon;
use App\Models\NexusModel;
use App\Models\SearchBox;
use App\Models\Torrent;
use App\Repositories\SearchBoxRepository;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Section';

    protected static ?int $navigationSort = 2;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.category');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('mode')
                    ->options(SearchBox::listModeOptions())
                    ->label(__('label.search_box.label'))
                    ->rules([
                        'required',
                        function () {
                            return function ($attribute, $value, $fail) {
                                //@todo how to get the editing record ?
                                $exists = Torrent::query()->where('category', $value)->exists();
                                do_log("check $attribute: $value torrent if exists: $exists");
//                                if ($exists) {
//                                    $fail("There are torrents belonging to this category that cannot be changed!");
//                                }
                            };
                        }
                    ])
                ,
                TextInput::make('name')->required()->label(__('label.search_box.taxonomy.name'))->required(),
                TextInput::make('image')
                    ->label(__('label.search_box.taxonomy.image'))
                    ->helperText(__('label.search_box.taxonomy.image_help'))
                    ->required()
                ,
                Select::make('icon_id')
                    ->options(Icon::query()->pluck('name', 'id')->toArray())
                    ->label(__('label.search_box.taxonomy.icon_id'))
                    ->required()
                ,
                TextInput::make('class_name')
                    ->label(__('label.search_box.taxonomy.class_name'))
                    ->helperText(__('label.search_box.taxonomy.class_name_help'))
                ,
                TextInput::make('sort_index')
                    ->default(0)
                    ->label(__('label.priority'))
                    ->helperText(__('label.priority_help'))
                ,

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('search_box.name')->label(__('label.search_box.label')),
                TextColumn::make('name')->label(__('label.search_box.taxonomy.name'))->searchable(),
                TextColumn::make('icon.name')->label(__('label.search_box.taxonomy.icon_id')),
                TextColumn::make('image')->label(__('label.search_box.taxonomy.image')),
                TextColumn::make('class_name')->label(__('label.search_box.taxonomy.class_name')),
                TextColumn::make('sort_index')->label(__('label.priority'))->sortable(),
            ])
            ->defaultSort('sort_index', 'desc')
            ->filters([
                SelectFilter::make('mode')
                    ->options(SearchBox::query()->pluck('name', 'id')->toArray())
                    ->label(__('label.search_box.label'))
                ,
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()->using(function (NexusModel $record) {
                    try {
                        $rep = new SearchBoxRepository();
                        $rep->deleteCategory($record->id);
                    } catch (Exception $exception) {
                        Filament::notify('danger', $exception->getMessage() ?: class_basename($exception));
                    }
                }),
            ])
            ->toolbarActions([
                DeleteBulkAction::make()->using(function (Collection $records) {
                    try {
                        $rep = new SearchBoxRepository();
                        $rep->deleteCategory($records->pluck('id')->toArray());
                    } catch (Exception $exception) {
                        Filament::notify('danger', $exception->getMessage() ?: class_basename($exception));
                    }
                }),
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
