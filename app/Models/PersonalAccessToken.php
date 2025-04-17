<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
class PersonalAccessToken extends SanctumPersonalAccessToken
{
    public function getAbilitiesTextAttribute(): string
    {
        if (in_array('*', $this->abilities)) {
            return 'ALL';
        }
        $result = [];
        foreach ($this->abilities as $ability) {
            if ($ability != '*') {
                $result[] = nexus_trans("route-permission.{$ability}.text");
            }
        }
        return implode(', ', $result);
    }
}
