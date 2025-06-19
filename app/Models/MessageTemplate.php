<?php

namespace App\Models;

use App\Enums\MessageTemplateNameEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessageTemplate extends NexusModel
{
    protected $fillable = ['name', 'content', 'language_id'];

    public $timestamps = true;

    protected $casts = [
        'name' => MessageTemplateNameEnum::class,
    ];

    public static function listAllNames(): array
    {
        $result = [];
        foreach (MessageTemplateNameEnum::cases() as $messageTemplate) {
            $result[$messageTemplate->value] = $messageTemplate->label();
        }
        return $result;
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public static function forRegisterWelcome($languageId, array $placeholders): null|string
    {
        $result = self::query()->where("language_id", $languageId)
            ->where('name', MessageTemplateNameEnum::REGISTER_WELCOME->value)
            ->first();
        return self::format($result, $placeholders);
    }

    private static function format(self|null $template, array $placeholders): null|string
    {
        if ($template && $template->content) {
            $search = array_map(function ($value) {return ":$value";}, array_keys($placeholders));
            return str_replace($search, array_values($placeholders), $template->content);
        }
        return null;
    }
}
