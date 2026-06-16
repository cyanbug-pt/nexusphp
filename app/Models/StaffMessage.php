<?php

namespace App\Models;

use App\Enums\ModelEventEnum;

class StaffMessage extends NexusModel
{
    protected $table = 'staffmessages';

    protected $fillable = [
        'sender', 'added', 'subject', 'msg', 'answeredby', 'answered', 'answer', 'permission',
    ];

    protected $casts = [
        'added' => 'datetime',
    ];

    public function send_user()
    {
        return $this->belongsTo(User::class, 'sender')->withDefault(['id' => 0, 'username' => 'System']);
    }

    public function answer_user()
    {
        return $this->belongsTo(User::class, 'answeredby');
    }

    public static function add(int $sender, string $subject, string $msg)
    {
        $record = self::query()->create([
            'sender' => $sender,
            'subject' => $subject,
            'msg' => $msg,
            'added' => now(),
        ]);
        fire_event(ModelEventEnum::STAFF_MESSAGE_CREATED, $record);
        return $record;
    }

}
