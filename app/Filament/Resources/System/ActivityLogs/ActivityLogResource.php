<?php

namespace App\Filament\Resources\System\ActivityLogs;

use App\Filament\Resources\System\ActivityLogs\Pages\ManageActivityLogs;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\QueryBuilder;
use Filament\Tables\Filters\QueryBuilder\Constraints\DateConstraint;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Models\Activity;
use UnitEnum;

class ActivityLogResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string | UnitEnum | null $navigationGroup = 'System';

    protected static ?int $navigationSort = 99;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.activity_logs');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function getLabel(): ?string
    {
        return self::getNavigationLabel();
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // subject 是被操作的对象，也是一个关联关系
                TextColumn::make('subject_type')
                    ->label(__("activity-log.subject_type"))
                ,

                TextColumn::make('subject_id')
                    ->label(__("activity-log.subject_id"))
                ,

                TextColumn::make('description')
                    ->label(__('label.description'))
                ,

                // causer 是操作者，一个关联关系
                TextColumn::make('causer.username')
                    ->label(__('label.operator'))
                ,

                TextColumn::make('created_at')
                    ->label(__('label.created_at'))
                    ,
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Filter::make('created_at_begin')
                    ->schema([
                        DateTimePicker::make('created_at_begin')->label(__('label.created_at_begin')),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['created_at_begin'],
                                fn (Builder $query, $value): Builder => $query->where('created_at', '>=', $value),
                            );
                    }),
                Filter::make('created_at_end')
                    ->schema([
                        DateTimePicker::make('created_at_end')->label(__('label.created_at_end')),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['created_at_end'],
                                fn (Builder $query, $value): Builder => $query->where('created_at', '<=', $value),
                            );
                    }),
                Filter::make('operator')
                    ->schema([
                        TextInput::make('operator')->label(__('label.operator')),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['operator'],
                                fn (Builder $query, $value): Builder => $query->whereHas('causer', function (Builder $query) use ($value) {
                                    $query->where('username', 'like', "%{$value}%");
                                }),
                            );
                    }),
            ])
            ->recordActions([
                ViewAction::make('view_properties')
                    ->label(__("activity-log.view_properties"))
                    ->icon('heroicon-o-information-circle')
                    ->color('gray')
                    ->schema(function ($record) {
                        $fields = [];
                        // 动态地从 JSON 数据创建 TextEntry
                        // 注意：这里需要确保 $record->properties 是一个数组
                        $properties = $record->properties->toArray();
                        foreach ($properties as $key => $value) {
                            // 如果值是数组或对象，美化输出
                            if (is_array($value) || is_object($value)) {
                                $value = json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                                $fields[] = TextEntry::make($key)->html()->getStateUsing(fn() => "<pre><code>$value</code></pre>");
                            } else {
                                $fields[] = TextEntry::make($key)->label(ucfirst($key));
                            }
                        }
                        return $fields;
                    })
                    ->action(null), // 无需执行任何操作
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
            'index' => ManageActivityLogs::route('/'),
        ];
    }
}
