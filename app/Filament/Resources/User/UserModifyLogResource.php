<?php

namespace App\Filament\Resources\User;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\User\UserModifyLogResource\Pages\ManageUserModifyLogs;
use App\Filament\Resources\User\UserModifyLogResource\Pages;
use App\Filament\Resources\User\UserModifyLogResource\RelationManagers;
use App\Models\UserModifyLog;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserModifyLogResource extends Resource
{
    protected static ?string $model = UserModifyLog::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'User';

    protected static ?int $navigationSort = 100;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.user_modify_logs');
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
                TextColumn::make('id'),
                TextColumn::make('user_id')->label('UID'),
                TextColumn::make('user.username')
                    ->label(nexus_trans("label.username"))
                    ->formatStateUsing(fn ($record) => username_for_admin($record->user_id))
                ,
                TextColumn::make('content')->label(nexus_trans("user-modify-log.content")),
                TextColumn::make('created_at')->label(nexus_trans("label.created_at")),
            ])
            ->filters([
                Filter::make('user_id')
                    ->schema([
                        TextInput::make('user_id')
                            ->label(__('UID'))
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['user_id'], fn (Builder $query, $value) => $query->where("user_id", $value));
                    })
                ,
                Filter::make('user')
                    ->schema([
                        TextInput::make('username')
                            ->label(__('label.username'))
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['username'], fn (Builder $query, $value) => $query->whereHas("user", function (Builder $query) use ($value) {
                            $query->where("username", $value);
                        }));
                    })
                ,
                Filter::make('content')
                    ->schema([
                        TextInput::make('content')
                            ->label(__('user-modify-log.content'))
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['content'], fn (Builder $query, $value) => $query->where("content", "like", "%{$data['content']}%"));
                    })
                ,
            ])
            ->defaultSort('id', 'desc')
            ->recordActions([
//                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageUserModifyLogs::route('/'),
        ];
    }
}
