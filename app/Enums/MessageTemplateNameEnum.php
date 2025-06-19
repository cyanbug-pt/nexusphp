<?php

namespace App\Enums;

use function PHPUnit\Framework\matches;

enum MessageTemplateNameEnum: string
{
    case REGISTER_WELCOME = "register_welcome";

    public function label(): string
    {
        return match ($this) {
            self::REGISTER_WELCOME => nexus_trans("message-template.register_welcome"),
            default => '',
        };
    }
}
