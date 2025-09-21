<?php

namespace App\Filament\Resources\User;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\User\AttendanceLogResource\Pages\ManageAttendanceLogs;
use App\Filament\OptionsTrait;
use App\Filament\Resources\User\AttendanceLogResource\Pages;
use App\Filament\Resources\User\AttendanceLogResource\RelationManagers;
use App\Models\AttendanceLog;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttendanceLogResource extends Resource
{
    use OptionsTrait;

    protected static ?string $model = AttendanceLog::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-pencil-square';

    protected static string | \UnitEnum | null $navigationGroup = 'User';

    protected static ?int $navigationSort = 11;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.attendance_log');
    }

    public static function getBreadcrumb(): string
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('uid')->formatStateUsing(fn ($state) => username_for_admin($state)),
                TextColumn::make('date')->label(__('attendance.fields.date'))->sortable(),
                TextColumn::make('points')->label(__('attendance.fields.points')),
                IconColumn::make('is_retroactive')
                    ->label(__('attendance.fields.is_retroactive'))
                    ->boolean(true)
                ,
                TextColumn::make('created_at')->label(__('label.created_at')),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Filter::make('id')
                    ->schema([
                        TextInput::make('id')
                            ->placeholder('UID')
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['id'], fn (Builder $query, $value) => $query->where("uid", $value));
                    })
                ,
                SelectFilter::make('is_retroactive')
                    ->options(self::getYesNoOptions())
                    ->label(__('attendance.fields.is_retroactive'))
                ,
                Filter::make('date')
                    ->schema([
                        DatePicker::make('date')
                            ->maxDate(now())
                            ->label(__('attendance.fields.date'))
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['date'], fn (Builder $query, $value) => $query->where("date", $value));
                    })
                ,
                Filter::make('created_at')
                    ->schema([
                        DatePicker::make('created_at')
                            ->label(__('label.created_at'))
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['created_at'], function (Builder $query, $value) {
                            $begin = Carbon::parse($value)->startOfDay();
                            $end = Carbon::parse($value)->endOfDay();
                            return $query->where("created_at", ">=", $begin)->where('created_at', '<=', $end);
                        });
                    })
                ,
            ])
            ->recordActions([
            ])
            ->toolbarActions([
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAttendanceLogs::route('/'),
        ];
    }
}
