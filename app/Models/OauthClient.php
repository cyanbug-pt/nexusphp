<?php

namespace App\Models;

use App\Models\Traits\NexusActivityLogTrait;
use Illuminate\Support\Str;
use Laravel\Passport\Client;

class OauthClient extends Client
{
    use NexusActivityLogTrait;

    protected static function booted(): void
    {
        static::creating(function (OauthClient $model) {
            $model->secret = Str::random(40);
        });
    }
    public function skipsAuthorization(): bool
    {
        return (bool)$this->skips_authorization;
    }
}
