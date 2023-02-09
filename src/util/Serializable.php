<?php

declare(strict_types=1);

namespace Util;

use Util\Contract\SerializableInterface;

abstract class Serializable implements SerializableInterface
{
    public abstract function toArray(): array;

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function __serialize(): array
    {
        return $this->toArray();
    }

    public abstract function __unserialize(array $data): void;
}
