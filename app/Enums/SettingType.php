<?php

declare(strict_types=1);

namespace App\Enums;

enum SettingType: string
{
    case String = 'string';
    case Email = 'email';
    case Url = 'url';
    case Json = 'json';
    case Boolean = 'boolean';
}
