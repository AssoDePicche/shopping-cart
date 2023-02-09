<?php

declare(strict_types=1);

namespace ValueObject;

use Util\Serializable;

final class ID extends Serializable
{
    private readonly string $value;

    public function __construct()
    {
        $this->value = md5(uniqid());
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
