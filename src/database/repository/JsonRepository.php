<?php

declare(strict_types=1);

namespace Database\Repository;

use ReflectionClass;
use Serialization\Serializer;

abstract class JsonRepository
{
    protected readonly Serializer $serializer;

    public function __construct()
    {
        $this->serializer = new Serializer(
            (new ReflectionClass($this))->getShortName(),
            true
        );
    }
}
