<?php

namespace App\Models;


class SiteLog extends NexusModel
{
    protected $table = 'sitelog';

    protected $fillable = ['added', 'txt', 'security_level', 'uid'];

}
