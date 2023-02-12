<?php

declare(strict_types=1);

namespace Database;

use Logger\Logger;
use PDO;
use PDOException;

final class Database
{
    private static ?PDO $connection = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getConnection(): ?PDO
    {
        if (self::$connection instanceof PDO) {
            return self::$connection;
        }

        try {
            $dsn = sprintf(
                '%s:host=%s:%s;dbname=%s;charset=utf8',
                $_ENV['DB_CONNECTION'],
                $_ENV['DB_HOST'],
                $_ENV['DB_PORT'],
                $_ENV['DB_DATABASE']
            );

            self::$connection = new PDO(
                $dsn,
                $_ENV['DB_USERNAME'],
                $_ENV['DB_PASSWORD'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]
            );
        } catch (PDOException $exception) {
            Logger::log($exception->getMessage(), Logger::ERROR);
        } finally {
            return self::$connection;
        }
    }
}
