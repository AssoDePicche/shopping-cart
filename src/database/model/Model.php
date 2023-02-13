<?php

declare(strict_types=1);

namespace Database\Model;

use PDO;
use PDOStatement;

abstract class Model
{
    protected PDOStatement $statement;

    public function __construct(
        protected readonly PDO $connection
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

    abstract function fetch(): object|bool;

    public function fetchAll(): array
    {
        return $this->statement->fetchAll();
    }
}
