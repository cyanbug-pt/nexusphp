<?php

namespace App\Filament\Resources\User;

use App\Repositories\BonusRepository;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\User\BonusLogResource\Pages\ManageBonusLogs;
use App\Filament\Resources\User\BonusLogResource\Pages;
use App\Models\BonusLogs;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use function Filament\Support\get_model_label;

class BonusLogResource extends Resource
{
    protected static ?string $model = BonusLogs::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'User';

    protected static ?int $navigationSort = 10;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.bonus_log');
    }

    public static function getModelLabel(): string
    {
        return sprintf('%s(%s)', get_model_label(static::getModel()), __('bonus-log.exclude_seeding_bonus'));
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->records(function (int $page, int $recordsPerPage, array $filters) {
                return self::listRecords($page, $recordsPerPage, $filters);
            })
            ->columns([
                TextColumn::make('uid')
                    ->formatStateUsing(fn ($state) => username_for_admin($state))
                    ->label(__('label.username'))
                ,
                TextColumn::make('business_type_text')
                    ->label(__('bonus-log.fields.business_type'))
                ,
                TextColumn::make('old_total_value')
                    ->label(__('bonus-log.fields.old_total_value'))
                    ->formatStateUsing(fn ($state) => $state >= 0 ? number_format($state) : '-')
                ,
                TextColumn::make('value')
                    ->formatStateUsing(fn ($record) => $record->old_total_value > $record->new_total_value ? "-" . number_format($record->value) : "+" . number_format($record->value))
                    ->label(__('bonus-log.fields.value'))
                ,
                TextColumn::make('new_total_value')
                    ->label(__('bonus-log.fields.new_total_value'))
                    ->formatStateUsing(fn ($state) => $state >= 0 ? number_format($state) : '-')
                ,
                TextColumn::make('comment')
                    ->label(__('label.comment'))
                ,
                TextColumn::make('created_at')
                    ->label(__('label.created_at'))
                ,
            ])
            ->filters([
                SelectFilter::make('category')
                    ->options(BonusLogs::listCategoryOptions(true))
                    ->default(BonusLogs::CATEGORY_COMMON)
                    ->selectablePlaceholder(false)
                    ->label(__('bonus-log.category'))
                ,
                SelectFilter::make('business_type')
                    ->options(BonusLogs::listBusinessTypeOptions())
                    ->label(__('bonus-log.fields.business_type'))
                    ->searchable(true)
                ,
                Filter::make('uid')
                    ->schema([
                        TextInput::make('uid')
                            ->label(__('label.username'))
                            ->placeholder('UID')
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['uid'], fn (Builder $query, $value) => $query->where("uid", $value));
                    })
                ,
            ])
            ->recordActions([
//                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
//                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageBonusLogs::route('/'),
        ];
    }

    private static function listRecords(int $page, int $perPage, array $filters = []): LengthAwarePaginator
    {
        $rep = new BonusRepository();
        $category = $filters['category']['value'] ?: BonusLogs::CATEGORY_COMMON;
        $userId = intval($filters['userId']['value'] ?? 0);
        $businessType = intval($filters['businessType']['value'] ?? 0);
        $list = $rep->getList($category, $userId, $businessType, $page, $perPage);
        $count = $rep->getCount($category, $userId, $businessType);
        return new LengthAwarePaginator($list, $count, $perPage, $page);
    }
}
