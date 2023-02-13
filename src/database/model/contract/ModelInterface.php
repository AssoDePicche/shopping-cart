<?php

declare(strict_types=1);

namespace Database\Model\Contract;

interface ModelInterface
{
    public function query(string $sql, array $params = []): bool;

    public function rowCount(): int;

    public function fetch(string $sql, array $params = []): object|bool;

    public function fetchAll(string $sql, array $params = []): array;
}
