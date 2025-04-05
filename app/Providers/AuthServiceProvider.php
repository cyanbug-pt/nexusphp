<?php

namespace App\Providers;

use App\Auth\NexusWebGuard;
use App\Auth\NexusWebUserProvider;
use App\Models\AudioCodec;
use App\Models\Category;
use App\Models\Codec;
use App\Models\Icon;
use App\Models\Media;
use App\Models\Plugin;
use App\Models\Processing;
use App\Models\SearchBox;
use App\Models\SecondIcon;
use App\Models\Source;
use App\Models\Standard;
use App\Models\Team;
use App\Models\User;
use App\Policies\CodecPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        SearchBox::class => CodecPolicy::class,
        Category::class => CodecPolicy::class,
        Icon::class => CodecPolicy::class,
        SecondIcon::class => CodecPolicy::class,

        Codec::class => CodecPolicy::class,
        AudioCodec::class => CodecPolicy::class,
        Source::class => CodecPolicy::class,
        Media::class => CodecPolicy::class,
        Standard::class => CodecPolicy::class,
        Team::class => CodecPolicy::class,
        Processing::class => CodecPolicy::class,

        Plugin::class => CodecPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //some plugin use this guard
        Auth::viaRequest('nexus-cookie', function (Request $request) {
            return get_user_from_cookie($request->cookie(), false);
        });

        Auth::extend('nexus-web', function ($app, $name, array $config) {
            // 返回 Illuminate\Contracts\Auth\Guard 的实例 ...
            return new NexusWebGuard($app['request'], new NexusWebUserProvider());
        });

        Auth::viaRequest('passkey', function (Request $request) {
            $passkey = $request->passkey;
            if (strlen($passkey) != 32) {
                return null;
            }
            return User::query()->where('passkey', $passkey)->first();
        });

    }

}
