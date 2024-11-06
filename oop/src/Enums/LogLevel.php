<?php
declare(strict_types=1);

namespace Nextgenphpchallenges\Oop\Enums;

enum LogLevel: string
{
    case log = 'log';
    case alert = 'alert';
    case danger = 'danger';
}
