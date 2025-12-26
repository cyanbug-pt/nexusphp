<?php

namespace App\Filament\Resources\User;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\User\BonusLogResource\Pages\ManageBonusLogs;
use App\Filament\Resources\User\BonusLogResource\Pages;
use App\Filament\Resources\User\BonusLogResource\RelationManagers;
use App\Models\BonusLogs;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
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
            ->columns([
                TextColumn::make('id')->sortable(),
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
            ->defaultSort('id', 'desc')
            ->filters([
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
                SelectFilter::make('business_type')
                    ->options(BonusLogs::listStaticProps(Arr::except(BonusLogs::$businessTypes, BonusLogs::$businessTypeBonus), 'bonus-log.business_types', true))
                    ->label(__('bonus-log.fields.business_type'))
                ,
//                Tables\Filters\Filter::make('exclude_seeding_bonus')
//                    ->toggle()
//                    ->label(__('bonus-log.exclude_seeding_bonus'))
//                    ->query(function (Builder $query, array $data) {
//                        if ($data['isActive']) {
//                            $query->whereNotIn("business_type", BonusLogs::$businessTypeBonus);
//                        }
//                    })
//                    ->default()
//                ,
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
}
