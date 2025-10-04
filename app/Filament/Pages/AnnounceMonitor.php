<?php
namespace App\Filament\Pages;

use Filament\Pages\Dashboard;
use Filament\Support\Enums\Width;
use App\Filament\Widgets\AnnounceMonitor\MaxUploadedUser;
use App\Models\Setting;
use Illuminate\Contracts\Support\Htmlable;

class AnnounceMonitor extends Dashboard
{
    protected Width|string|null $maxContentWidth = 'full';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-archive-box';

    protected static string $routePath = 'announce-monitor';

    protected static string | \UnitEnum | null $navigationGroup = 'Tracker';

    protected static ?int $navigationSort = 15;

    public function getTitle(): string|Htmlable
    {
        return self::getNavigationLabel();
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.sidebar.announce_monitor');
    }

    /**
     * @return bool
     */
    public static function shouldRegisterNavigation(): bool
    {
        return Setting::getIsRecordAnnounceLog() && config('clickhouse.connection.host') != '';
    }

    public function getWidgets(): array
    {
        return [
            MaxUploadedUser::class,
        ];
    }
}
