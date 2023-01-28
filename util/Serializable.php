<?php

namespace Util;

use Util\Contract\SerializableInterface;
use Util\Trait\SerializableTrait;

abstract class Serializable implements SerializableInterface
{
    use SerializableTrait;

    public abstract function toArray(): array;
}
