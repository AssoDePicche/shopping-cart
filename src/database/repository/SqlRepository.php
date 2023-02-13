<?php

declare(strict_types=1);

namespace Database\Repository;

use Database\Builder\Contract\SqlQueryBuilder;
use Database\Builder\QueryBuilder;
use Database\Model\Contract\ModelInterface;
use Database\Model\ModelFactory;

abstract class SqlRepository
{
    protected readonly ModelInterface $model;

    protected readonly SqlQueryBuilder $queryBuilder;

    public function __construct()
    {
        $this->model = ModelFactory::build();

        $this->queryBuilder = new QueryBuilder;
    }
}
