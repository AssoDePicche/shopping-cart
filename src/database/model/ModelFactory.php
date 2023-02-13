<?php

declare(strict_types=1);

namespace Database\Model;

use Database\Database;
use Database\Model\Contract\ModelInterface;

final class ModelFactory
{
    public static function build(): ModelInterface
    {
        return new Model(Database::getConnection());
    }
}
