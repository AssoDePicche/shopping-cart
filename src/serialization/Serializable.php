<?php

declare(strict_types=1);

namespace Serialization;

use JsonSerializable;

abstract class Serializable implements JsonSerializable
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
