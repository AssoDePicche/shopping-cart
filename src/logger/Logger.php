<?php

declare(strict_types=1);

namespace Logger;

use DateTime;
use DateTimeZone;
use Util\Singleton;

final class Logger extends Singleton
{
    public const CRITICAL = 'CRITICAL';

    public const ERROR = 'ERROR';

    public const WARNING = 'WARNING';

    public const INFO = 'INFO';

    public const DEBUG = 'DEBUG';

    private mixed $stream;

    public function __construct()
    {
        $this->stream = fopen(dirname(__DIR__, 2) . '/log/application.log', 'a+');
    }

    public function write(string $message, string $level): void
    {
        $dateTime = new DateTime(timezone: new DateTimeZone(date_default_timezone_get()));

        $timestamp = $dateTime->format('Y-m-d g:i A');

        $log = sprintf("[%s] %s %s %s", $level, $timestamp, $message, PHP_EOL);

        fwrite($this->stream, $log);
    }

    public static function log(string $message, string $level): void
    {
        $logger = self::getInstance();

        $logger->write($message, $level);
    }

    public function __destruct()
    {
        fclose($this->stream);
    }
}
