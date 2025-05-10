<?php

namespace App\Models;

use App\Enums\SeedBoxRecord\IpAsnEnum;
use App\Enums\SeedBoxRecord\IsAllowedEnum;
use App\Enums\SeedBoxRecord\TypeEnum;
use App\Repositories\SeedBoxRepository;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Nexus\Database\NexusDB;

class SeedBoxRecord extends NexusModel
{
    protected $fillable = ['type', 'uid', 'status', 'operator', 'bandwidth', 'ip', 'ip_begin', 'ip_end', 'ip_begin_numeric', 'ip_end_numeric',
        'comment', 'version', 'is_allowed', 'asn'
    ];

    public $timestamps = true;

    const TYPE_USER = 1;
    const TYPE_ADMIN = 2;

    public static array $types = [
        self::TYPE_USER => ['text' => 'User'],
        self::TYPE_ADMIN => ['text' => 'Administrator'],
    ];

    const STATUS_UNAUDITED = 0;
    const STATUS_ALLOWED = 1;
    const STATUS_DENIED = 2;

    public static array $status = [
        self::STATUS_UNAUDITED => ['text' => 'Unaudited'],
        self::STATUS_ALLOWED => ['text' => 'Allowed'],
        self::STATUS_DENIED => ['text' => 'Denied'],
    ];

    protected static function booted(): void
    {
        static::saved(function (SeedBoxRecord $model) {
            self::updateCache($model);
        });
        static::deleted(function (SeedBoxRecord $model) {
            self::updateCache($model);
        });
    }

    private static function updateCache(SeedBoxRecord $model): void
    {
        SeedBoxRepository::updateCache(
            $model->type == TypeEnum::ADMIN->value ? 0 : $model->uid,
            TypeEnum::from($model->type),
            IsAllowedEnum::from($model->is_allowed),
            !empty($model->ip) ? IpAsnEnum::IP : IpAsnEnum::ASN,
        );
    }

    public static function getValidQuery(TypeEnum $type, IsAllowedEnum $isAllowed, IpAsnEnum $field)
    {
        $query = self::query()
            ->where('status', self::STATUS_ALLOWED)
            ->where('type', $type->value)
            ->where('is_allowed', $isAllowed->value)
        ;
        if ($field == IpAsnEnum::IP) {
            $query->whereNotNull("ip");
        } elseif ($field == IpAsnEnum::ASN) {
            $query->where("asn", ">", 0);
        } else {
            throw new \InvalidArgumentException("Invalid ipOrAsn");
        }
        return $query;
    }

    protected function typeText(): Attribute
    {
        return new Attribute(
            get: fn($value, $attributes) => nexus_trans("seed-box.type_text." . $attributes['type'])
        );
    }

    protected function ipRange(): Attribute
    {
        return new Attribute(
            get: fn($value, $attributes) => $attributes['ip'] ?: sprintf('%s ~ %s', $attributes['ip_begin'] ?? '', $attributes['ip_end'] ?? ''),
        );
    }

    protected function statusText(): Attribute
    {
        return new Attribute(
            get: fn($value, $attributes) => nexus_trans("seed-box.status_text." . $attributes['status'])
        );
    }

    public static function listTypes($key = null): array
    {
        $result = self::$types;
        $keyValues = [];
        foreach ($result as $type => &$info) {
            $info['text'] = nexus_trans("seed-box.type_text.$type");
            if ($key !== null) {
                $keyValues[$type] = $info[$key];
            }
        }
        return $key === null ? $result : $keyValues;
    }

    public static function listStatus($key = null): array
    {
        $result = self::$status;
        $keyValues = [];
        foreach ($result as $status => &$info) {
            $info['text'] = nexus_trans("seed-box.status_text.$status");
            if ($key !== null) {
                $keyValues[$status] = $info[$key];
            }
        }
        return $key === null ? $result : $keyValues;
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'uid');
    }


}
