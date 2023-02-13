<?php

declare(strict_types=1);

namespace Database\Model;

use Database\Model\Contract\ModelInterface;
use PDO;
use PDOStatement;

final class Model implements ModelInterface
{
    protected PDOStatement $statement;

    public function __construct(
        protected readonly PDO $connection
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

    public function fetch(string $sql, array $params = []): object|bool
    {
        $this->query($sql, $params);

        return $this->statement->fetch();
    }

    public function fetchAll(string $sql, array $params = []): array
    {
        $this->query($sql, $params);

        return $this->statement->fetchAll();
    }
}
