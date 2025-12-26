<?php

namespace App\Filament\Resources\User;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\User\UserMetaResource\Pages\ListUserMetas;
use App\Filament\Resources\User\UserMetaResource\Pages\CreateUserMeta;
use App\Filament\Resources\User\UserMetaResource\Pages\EditUserMeta;
use App\Filament\Resources\User\UserMetaResource\Pages;
use App\Filament\Resources\User\UserMetaResource\RelationManagers;
use App\Models\NexusModel;
use App\Models\UserMeta;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

class UserMetaResource extends Resource
{
    protected static ?string $model = UserMeta::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'User';

    protected static ?int $navigationSort = 8;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.user_props');
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
                TextColumn::make('uid')
                    ->searchable()
                    ->label(__('label.username'))
                    ->formatStateUsing(fn ($state) => username_for_admin($state))
                ,
                TextColumn::make('meta_key_text')
                    ->label(__('label.name'))
                ,
                TextColumn::make('deadline')
                    ->label(__('label.deadline'))
                ,
                TextColumn::make('created_at')
                    ->label(__('label.created_at'))
                    ->formatStateUsing(fn ($state) => format_datetime($state))
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
                SelectFilter::make('meta_key')
                    ->options(UserMeta::listProps())
                    ->label(__('label.name'))
                ,
            ])
            ->recordActions([
                DeleteAction::make()->using(function (NexusModel $record) {
                    $record->delete();
                    clear_user_cache($record->uid);
                    do_log(sprintf("user: %d meta: %s was del by %s", $record->uid, $record->meta_key, Auth::user()->username));
                }),
            ])
            ->toolbarActions([
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
            'index' => ListUserMetas::route('/'),
            'create' => CreateUserMeta::route('/create'),
            'edit' => EditUserMeta::route('/{record}/edit'),
        ];
    }
}
