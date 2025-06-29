<?php

namespace App\Filament\Widgets\AnnounceMonitor;

use App\Models\AnnounceLog;
use App\Repositories\AnnounceLogRepository;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\HtmlString;

class MaxUploadedUser extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->recordTitle("ssss")
            ->heading(fn () => __('announce-monitor.max_uploaded_user', ['interval' => ' 1 ' . __('nexus.time_units.hour')]))
            ->query(AnnounceLog::query())
            ->defaultPaginationPageOption(null)
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->label(__('announce-log.user_id'))
                    ->formatStateUsing(fn ($state) => username_for_admin($state))
                ,
                Tables\Columns\TextColumn::make('uploaded_total')
                    ->label(__('announce-log.uploaded_total'))
                    ->formatStateUsing(fn ($state) => mksize($state))
                ,
            ]);
    }

    public function getTableRecords(): Collection|Paginator|CursorPaginator
    {
        $rep = new AnnounceLogRepository();
        $list = $rep->listMaxUploadedUser(1);
        $items = [];
        foreach ($list as $index => $item) {
            $record = new AnnounceLog($item);
            $record->request_id = $index;
            $items[] = $record;
        }
        return new Collection($items);
    }

}
