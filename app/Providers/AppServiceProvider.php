<?php

namespace App\Providers;

use App\Http\Middleware\Locale;
use Carbon\Carbon;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Passport\Passport;
use Nexus\Nexus;
use Filament\Facades\Filament;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        do_action('nexus_register');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        global $plugin;
        $plugin->start();
        DB::connection(config('database.default'))->enableQueryLog();
        $forceScheme = strtolower(env('FORCE_SCHEME'));
        if (env('APP_ENV') == "production" && in_array($forceScheme, ['https', 'http'])) {
            URL::forceScheme($forceScheme);
        }

        Filament::serving(function () {
            Filament::registerNavigationGroups([
                'User',
                'Torrent',
                'Role & Permission',
                'Other',
                'Section',
                'Oauth',
                'System',
            ]);
        });

        FilamentAsset::register([
            Css::make("sprites", asset('styles/sprites.css')),
            Css::make("admin", asset('styles/admin.css')),
        ]);

        do_action('nexus_boot');
    }
}
