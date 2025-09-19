<?php

namespace App\Filament\Resources\User;

use App\Filament\Resources\User\BonusLogResource\Pages;
use App\Filament\Resources\User\BonusLogResource\RelationManagers;
use App\Models\BonusLogs;
use Filament\Forms;
use Filament\Forms\Form;
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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'User';

    protected static ?int $navigationSort = 10;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.bonus_log');
    }

    public static function getModelLabel(): string
    {
        return sprintf('%s(%s)', get_model_label(static::getModel()), __('bonus-log.exclude_seeding_bonus'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('uid')
                    ->formatStateUsing(fn ($state) => username_for_admin($state))
                    ->label(__('label.username'))
                ,
                Tables\Columns\TextColumn::make('business_type_text')
                    ->label(__('bonus-log.fields.business_type'))
                ,
                Tables\Columns\TextColumn::make('old_total_value')
                    ->label(__('bonus-log.fields.old_total_value'))
                    ->formatStateUsing(fn ($state) => $state >= 0 ? number_format($state) : '-')
                ,
                Tables\Columns\TextColumn::make('value')
                    ->formatStateUsing(fn ($record) => $record->old_total_value > $record->new_total_value ? "-" . number_format($record->value) : "+" . number_format($record->value))
                    ->label(__('bonus-log.fields.value'))
                ,
                Tables\Columns\TextColumn::make('new_total_value')
                    ->label(__('bonus-log.fields.new_total_value'))
                    ->formatStateUsing(fn ($state) => $state >= 0 ? number_format($state) : '-')
                ,
                Tables\Columns\TextColumn::make('comment')
                    ->label(__('label.comment'))
                ,
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('label.created_at'))
                ,
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Tables\Filters\Filter::make('uid')
                    ->form([
                        Forms\Components\TextInput::make('uid')
                            ->label(__('label.username'))
                            ->placeholder('UID')
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['uid'], fn (Builder $query, $value) => $query->where("uid", $value));
                    })
                ,
                Tables\Filters\SelectFilter::make('business_type')
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
            ->actions([
//                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBonusLogs::route('/'),
        ];
    }
}
