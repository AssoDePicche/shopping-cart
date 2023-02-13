<?php

declare(strict_types=1);

namespace Database\Model;

use Database\Database;

final class ModelFactory
{
    public static function build(): Model
    {
        return new Model(Database::getConnection());
    }
}
