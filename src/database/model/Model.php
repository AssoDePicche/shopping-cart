<?php

declare(strict_types=1);

namespace Database\Model;

use PDO;
use PDOStatement;

abstract class Model
{
    private ?PDOStatement $statement;

    public function __construct(
        private readonly PDO $connection
    ) {
    }

    public function prepare(string $sql): void
    {
        $this->statement = $this->connection->prepare($sql);
    }

    public function execute(array $params = null): bool
    {
        return $this->statement->execute($params);
    }

    public function rowCount(): int
    {
        return $this->statement->rowCount();
    }

    public function fetch(string $class = null): object|bool
    {
        return $this->statement->fetchObject($class);
    }

    public function fetchAll(): array
    {
        return $this->statement->fetchAll();
    }
}
