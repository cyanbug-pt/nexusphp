<?php

namespace App\Filament\Resources\User;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\User\HitAndRunResource\Pages\ListHitAndRuns;
use App\Filament\Resources\User\HitAndRunResource\Pages\ViewHitAndRun;
use App\Filament\Resources\User\HitAndRunResource\Pages;
use App\Filament\Resources\User\HitAndRunResource\RelationManagers;
use App\Models\HitAndRun;
use App\Models\User;
use App\Repositories\HitAndRunRepository;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;
use Filament\Infolists\Components;
use Filament\Infolists;
use Nette\Utils\Html;

class HitAndRunResource extends Resource
{
    protected static ?string $model = HitAndRun::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-beaker';

    protected static string | \UnitEnum | null $navigationGroup = 'User';

    protected static ?int $navigationSort = 3;

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.hit_and_runs');
    }

    public static function getBreadcrumb(): string
    {
        return self::getNavigationLabel();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('uid')->searchable(),
                TextColumn::make('user.username')
                    ->searchable()
                    ->label(__('label.username'))
                    ->formatStateUsing(fn ($record) => new HtmlString(get_username($record->uid, false, true, true, true)))
                ,

                TextColumn::make('torrent.name')->limit(30)->label(__('label.torrent.label')),
                TextColumn::make('snatch.uploadText')->label(__('label.uploaded')),
                TextColumn::make('snatch.downloadText')->label(__('label.downloaded')),
                TextColumn::make('snatch.shareRatio')->label(__('label.ratio')),
                TextColumn::make('seedTimeRequired')->label(__('label.seed_time_required')),
                TextColumn::make('inspectTimeLeft')->label(__('label.inspect_time_left')),
                TextColumn::make('statusText')->label(__('label.status')),
                TextColumn::make('created_at')->label(__('label.created_at')),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                Filter::make('uid')
                    ->schema([
                        TextInput::make('uid')
                            ->label('UID')
                            ->placeholder('UID')
                        ,
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->when($data['uid'], fn (Builder $query, $uid) => $query->where("uid", $uid));
                    })
                ,
                SelectFilter::make('status')->options(HitAndRun::listStatus(true))->label(__('label.status')),
                Filter::make('created_at_begin')
                    ->schema([
                        DatePicker::make('created_at_begin')
                            ->maxDate(now())
                            ->label(__('label.created_at_begin'))
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['created_at_begin'], fn (Builder $query, $value) => $query->where("created_at", '>=', $value));
                    })
                ,
                Filter::make('created_at_end')
                    ->schema([
                        DatePicker::make('created_at_end')
                            ->maxDate(now())
                            ->label(__('label.created_at_end'))
                        ,
                    ])->query(function (Builder $query, array $data) {
                        return $query->when($data['created_at_end'], fn (Builder $query, $value) => $query->where("created_at", '<=', $value));
                    })
                ,
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->groupedBulkActions([
                BulkAction::make('Pardon')->action(function (Collection $records) {
                    $idArr = $records->pluck('id')->toArray();
                    $rep = new HitAndRunRepository();
                    $rep->bulkPardon(['id' => $idArr], Auth::user());
                })
                ->deselectRecordsAfterCompletion()
                ->label(__('admin.resources.hit_and_run.bulk_action_pardon'))
                    ->icon('heroicon-o-x-mark')
                ,
                DeleteBulkAction::make('bulkDelete')
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id'),
                TextEntry::make('statusText')
                    ->label(__("label.status"))
                ,
                TextEntry::make('uid')
                    ->formatStateUsing(fn ($record) => username_for_admin($record->uid))
                    ->label(__("label.username"))
                ,
                TextEntry::make('torrent_id')
                    ->formatStateUsing(fn ($record) => $record->torrent->name)
                    ->label(__("label.torrent.label"))
                ,
                TextEntry::make('snatch.uploadedText')
                    ->label(__("label.uploaded"))
                ,
                TextEntry::make('snatch.downloadedText')
                    ->label(__("label.downloaded"))
                ,
                TextEntry::make('snatch.shareRatio')
                    ->label(__("label.ratio"))
                ,
                TextEntry::make('seedTimeRequired')
                    ->label(__("label.seed_time_required"))
                ,
                TextEntry::make('inspectTimeLeft')
                    ->label(__("label.inspect_time_left"))
                ,
                TextEntry::make('comment')
                    ->formatStateUsing(fn ($record) => new HtmlString(nl2br($record->comment)))
                    ->label(__("label.comment"))
                ,
                TextEntry::make('created_at')
                    ->label(__("label.created_at"))
                ,
                TextEntry::make('updated_at')
                    ->label(__("label.updated_at"))
                ,
                ])->columns(4);

    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['user', 'torrent', 'snatch', 'torrent.basic_category']);
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
            'index' => ListHitAndRuns::route('/'),
//            'create' => Pages\CreateHitAndRun::route('/create'),
//            'edit' => Pages\EditHitAndRun::route('/{record}/edit'),
            'view' => ViewHitAndRun::route('/{record}'),
        ];
    }
}
