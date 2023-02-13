<?php

declare(strict_types=1);

namespace Database\Model;

use Database\Builder\Contract\SqlQueryBuilder;
use PDO;
use PDOStatement;

abstract class Model
{
    protected PDOStatement $statement;

    public function __construct(
        protected readonly PDO $connection,
        protected readonly SqlQueryBuilder $queryBuilder
    ) {
    }

    public function query(string $sql, array $params = []): bool
    {
        $this->statement = $this->connection->prepare($sql);

        return $this->statement->execute($params);
    }

    public function rowCount(): int
    {
        return $this->statement->rowCount();
    }

    abstract function fetch(): object|bool;

    abstract function fetchAll(): array;
}
