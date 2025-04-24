<?php

namespace App\Models;

use Laravel\Passport\Client;
use Ramsey\Uuid;

class OauthProvider extends NexusModel
{
    protected $fillable = [
        'uuid', 'name', 'client_id', 'client_secret', 'authorization_endpoint_url', 'token_endpoint_url',
        'user_info_endpoint_url', 'id_claim', 'username_claim', 'email_claim', 'enabled', 'priority',
    ];

    public $timestamps = true;

    protected $casts = [
        'enabled' => 'boolean',
    ];
    protected static function booted(): void
    {
        static::creating(function (OauthProvider $model) {
            $model->uuid = Uuid\v4();
        });
    }
}
