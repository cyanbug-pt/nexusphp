<?php

namespace App\Filament\Widgets;

use Filament\Actions\Contracts\HasActions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use App\Models\User;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class LatestUsers extends BaseWidget implements HasActions
{
    protected static ?int $sort = 1;

    protected function getTableHeading(): string | Htmlable | null
    {
        return __('dashboard.latest_user.page_title');
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableQuery(): Builder
    {
        return User::query()->orderBy('id', 'desc')->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')
                ->label(__('label.user.username'))
                ->formatStateUsing(fn ($state) => username_for_admin($state))
            ,
            TextColumn::make('email')->label(__('label.email')),
            BadgeColumn::make('status')->colors(['success' => 'confirmed', 'danger' => 'pending'])->label(__('label.status')),
            TextColumn::make('added')->dateTime()->label(__('label.added')),
        ];
    }
}
