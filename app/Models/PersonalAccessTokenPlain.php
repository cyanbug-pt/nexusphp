<?php

namespace App\Models;


class PersonalAccessTokenPlain extends NexusModel
{
    protected $fillable = ['access_token_id', 'plain_text_token'];

    public $timestamps = true;
}
