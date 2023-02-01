<?php

namespace Util\Contract;

interface SerializableInterface
{
    public function toArray(): array;

    public function jsonSerialize(): array;

    public function __serialize(): array;

    public function __unserialize(array $data): void;
}
