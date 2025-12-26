<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;

class IpLog extends NexusModel
{
    protected $table = 'iplog';

    protected $fillable = ['ip', 'userid', 'access', 'uri', 'count'];

    protected function ipLocation(): Attribute
    {
        return new Attribute(
            get: fn (mixed $value, array $attributes) => $this->getIpLocation($attributes['ip'])
        );
    }

    private function getIpLocation(string $ip)
    {
        $result = get_ip_location_from_geoip($ip);
        $out = $result['name'];
        $suffix = [];
        if (!empty($result['city_en'])) {
            $suffix[] = $result['city_en'];
        }
        if (!empty($result['country_en'])) {
            $suffix[] = $result['country_en'];
        }
        if (!empty($result['continent_en'])) {
            $suffix[] = $result['continent_en'];
        }
        if (!empty($suffix)) {
            $out .= " " . implode(', ', $suffix);
        }
        return $out;
    }
}
