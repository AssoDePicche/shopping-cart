<?php

namespace Util\Trait;

trait SerializableTrait
{
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    public function __serialize(): array
    {
        return $this->toArray();
    }
}
