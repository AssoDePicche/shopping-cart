<?php

namespace Util\Contract;

use JsonSerializable;

interface SerializableInterface extends JsonSerializable
{
    public function toArray(): array;

    public function __serialize(): array;

    public function __unserialize(array $data): void;
}
