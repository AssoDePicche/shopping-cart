<?php

namespace Cart;

use Cart\Contract\ProductInterface;
use InvalidArgumentException;
use JsonSerializable;

final class Product implements ProductInterface, JsonSerializable
{
    public function __construct(
        private readonly string $name,
        private Price $unitPrice,
        private int $availableQuantity
    ) {
        strlen($name) === 0 && throw new InvalidArgumentException();

        $availableQuantity < 0 && throw new InvalidArgumentException();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice->dollar;
    }

    public function getAvailableQuantity(): int
    {
        return $this->availableQuantity;
    }

    public function decreaseAvailableQuantity(int $amount = 1): void
    {
        $this->availableQuantity - $amount < 0 && throw new InvalidArgumentException();

        $this->availableQuantity -= $amount;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'name' => $this->name,
            'price' => $this->unitPrice->cent,
            'available quantity' => $this->availableQuantity
        ];
    }
}
