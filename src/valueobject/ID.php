<?php

declare(strict_types=1);

namespace ValueObject;

use Serialization\Serializable;
use ValueObject\Contract\IdentifierInterface;

final class ID extends Serializable implements IdentifierInterface
{
    private readonly string $value;

    public function __construct()
    {
        $this->value = md5(uniqid());
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function toArray(): array
    {
        return [
            'value' => $this->value
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->value = $data['value'];
    }
}
