<?php

use Nextgenphpchallenges\Oop\Classes\FileLogger;
use Nextgenphpchallenges\Oop\Classes\Logger;
use Nextgenphpchallenges\Oop\Enums\LogLevel;

require __DIR__ . '/../vendor/autoload.php';

$logger = new Logger(new FileLogger('./logs.txt'));

$logger->log(LogLevel::alert, 'Message 1', ['data1' => 1, 'data2' => 2]);
$logger->log(LogLevel::danger, 'Message 2', ['data3' => 1, 'data4' => 2]);
$logger->log(LogLevel::log, 'Message 3', ['data5' => 1, 'data6' => 2]);
