<?php

namespace App\Models;

class Passkey extends NexusModel
{
    protected $table = 'user_passkeys';

    public $timestamps = true;

    protected $fillable = [
        'id', 'user_id', 'AAGUID', 'credential_id', 'public_key', 'counter',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function AAGUID() {
        $guid = $this->AAGUID;
        return sprintf(
            '%s-%s-%s-%s-%s',
            substr($guid, 0, 8),
            substr($guid, 8, 4),
            substr($guid, 12, 4),
            substr($guid, 16, 4),
            substr($guid, 20, 12)
        );
    }

}
