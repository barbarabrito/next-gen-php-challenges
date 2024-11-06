<?php
declare(strict_types=1);

namespace Nextgenphpchallenges\Oop\Classes;

class FileLogger
{
    private $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function writeLog(string $message): void
    {
        $fileHandle = fopen($this->filePath, 'a');
        if (!$fileHandle) {
            throw new \Exception("Unable to open the file: $this->filePath");
        }
        
        fwrite($fileHandle, $message . PHP_EOL);
        fclose($fileHandle);
    }
}
