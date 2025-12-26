<?php

namespace App\Filament\Resources\System\IpLogs;

use App\Filament\Resources\System\IpLogs\Pages\ManageIpLogs;
use App\Models\IpLog;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class IpLogResource extends Resource
{
    protected static ?string $model = IpLog::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?int $navigationSort = 3;

    protected static string | UnitEnum | null $navigationGroup = 'System';

    public static function getLabel(): ?string
    {
        return __('ip-log.label');
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
                TextColumn::make('userid')
                    ->label('UID')
                ,
                TextColumn::make('usernameForAdmin')
                    ->label(__('label.username'))
                ,
                TextColumn::make('ip')
                    ->label('IP')
                ,
                TextColumn::make('ipLocation')
                    ->label(__('ip-log.ip_location'))
                ,
                TextColumn::make('uri')
                    ->label(__('ip-log.uri'))
                ,
                TextColumn::make('count')
                    ->label(__('ip-log.count'))
                ,
                TextColumn::make('access')
                    ->label(__('ip-log.access'))
                    ->tooltip(__('ip-log.access_tooltip'))
                ,
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Filter::make('uid')
                    ->schema([
                        TextInput::make('uid')->label('UID'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['uid'],
                                fn (Builder $query, $value): Builder => $query->where('userid', $value),
                            );
                    }),
                Filter::make('ip')
                    ->schema([
                        TextInput::make('ip')->label('IP'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['ip'],
                                fn (Builder $query, $value): Builder => $query->where('ip', $value),
                            );
                    }),
                Filter::make('access_begin')
                    ->schema([
                        DateTimePicker::make('access_begin')->label(__('ip-log.access_begin')),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['access_begin'],
                                fn (Builder $query, $value): Builder => $query->where('access', '>=', $value),
                            );
                    }),
                Filter::make('access_end')
                    ->schema([
                        DateTimePicker::make('access_end')->label(__('ip-log.access_end')),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['access_end'],
                                fn (Builder $query, $value): Builder => $query->where('access', '<=', $value),
                            );
                    }),
            ])
            ->recordActions([
//                ViewAction::make(),
//                EditAction::make(),
//                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
//                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageIpLogs::route('/'),
        ];
    }
}
