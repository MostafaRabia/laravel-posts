<?php

namespace App\Enums;

enum HttpCode: int
{
    case OK = 200;
    case CREATED = 201;

    public function message(): string
    {
        return match($this) {
            self::OK => 'OK',
            self::CREATED => 'CREATED',
        };
    }
}
