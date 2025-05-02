<?php

namespace App\Models;

use Laravel\Passport\Client;
use Nexus\Database\NexusDB;
use Ramsey\Uuid;

class OauthProvider extends NexusModel
{
    protected $fillable = [
        'uuid', 'name', 'client_id', 'client_secret', 'authorization_endpoint_url', 'token_endpoint_url',
        'user_info_endpoint_url', 'id_claim', 'username_claim', 'email_claim', 'enabled', 'priority',
        'level_claim', 'level_limit',
    ];

    public $timestamps = true;

    const NEW_UUID_CACHE_KEY = 'new_oauth_provider_uuid';

    protected $casts = [
        'enabled' => 'boolean',
    ];
    protected static function booted(): void
    {
        static::creating(function (OauthProvider $model) {
            $model->uuid = self::getNewUuid();
        });
        static::created(function (OauthProvider $model) {
            NexusDB::cache_del(self::NEW_UUID_CACHE_KEY);
        });
    }

    public static function getCallbackUrl(string $uuid): string
    {
        return sprintf("%s/oauth/callback/%s", getSchemeAndHttpHost(), $uuid);
    }

    private static function getNewUuid(): string
    {
        return NexusDB::remember(self::NEW_UUID_CACHE_KEY, 86400 * 365, function () {
            return UUid\v4();
        });
    }
}
