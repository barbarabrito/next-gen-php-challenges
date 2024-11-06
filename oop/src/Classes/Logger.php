<?php
declare(strict_types=1);

namespace Nextgenphpchallenges\Oop\Classes;

class Logger
{
    private $fileLogger;

    public function __construct(FileLogger $fileLogger)
    {
        $this->fileLogger = $fileLogger;       
    } 

    public function log($logLevel, string $message, array $data): void
    {
        $dateTime = $this->getFormattedDateTime();
        $encodedData = json_encode($data);
        $logMessage = "{$dateTime} | {$logLevel->value}: $message $encodedData" . PHP_EOL;

        $this->printLogMessage($logMessage);
        $this->fileLogger->writeLog($logMessage);
    }

    public function getFormattedDateTime(): string
    {
        date_default_timezone_set('America/Sao_Paulo');
        return (new \DateTime())->format('d/m/Y H:i:s');
    }

    public function printLogMessage(string $logMessage): void
    {
        echo $logMessage;
    }
}