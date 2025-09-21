<?php

namespace App\Filament\Resources\User;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\User\ClaimResource\Pages\ListClaims;
use App\Filament\Resources\User\ClaimResource\Pages\CreateClaim;
use App\Filament\Resources\User\ClaimResource\Pages\EditClaim;
use App\Filament\Resources\User\ClaimResource\Pages;
use App\Filament\Resources\User\ClaimResource\RelationManagers;
use App\Models\Claim;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class ClaimResource extends Resource
{
    protected static ?string $model = Claim::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'User';

    protected static ?int $navigationSort = 4;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.claims');
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
                TextColumn::make('uid')->searchable(),
                TextColumn::make('user.username')
                    ->label(__('label.user.label'))
                    ->searchable()
                    ->formatStateUsing(fn ($record) => new HtmlString(get_username($record->uid, false, true, true, true)))
                ,
                TextColumn::make('torrent.name')->limit(40)->label(__('label.torrent.label'))->searchable(),
                TextColumn::make('torrent.size')->label(__('label.torrent.size'))->formatStateUsing(fn (Model $record) => mksize($record->torrent->size)),
                TextColumn::make('torrent.added')->label(__('label.torrent.ttl'))->formatStateUsing(fn (Model $record) => mkprettytime(abs($record->torrent->added->diffInSeconds()))),
                TextColumn::make('created_at')->label(__('label.created_at'))->dateTime(),
                TextColumn::make('last_settle_at')->label(__('label.claim.last_settle_at'))->dateTime(),
                TextColumn::make('seedTimeThisMonth')->label(__('label.claim.seed_time_this_month')),
                TextColumn::make('uploadedThisMonth')->label(__('label.claim.uploaded_this_month')),
                BooleanColumn::make('isReachedThisMonth')->label(__('label.claim.is_reached_this_month')),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Filter::make('uid')
                    ->schema([
                        TextInput::make('uid')
                            ->label('UID')
                            ->placeholder('UID')
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['uid'], fn (Builder $query, $uid) => $query->where("uid", $uid));
                    })
                ,
                Filter::make('torrent_id')
                    ->schema([
                        TextInput::make('torrent_id')
                            ->label(__('claim.fields.torrent_id'))
                            ->placeholder(__('claim.fields.torrent_id'))
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['torrent_id'], fn (Builder $query, $value) => $query->where("torrent_id", $value));
                    })
                ,
            ])
            ->recordActions([
//                Tables\Actions\EditAction::make(),
            ])
            ->toolbarActions([
//                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['user', 'torrent', 'snatch']);
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
            'index' => ListClaims::route('/'),
            'create' => CreateClaim::route('/create'),
            'edit' => EditClaim::route('/{record}/edit'),
        ];
    }
}
