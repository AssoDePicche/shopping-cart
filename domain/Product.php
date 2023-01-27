<?php

namespace Cart;

use Cart\Contract\ProductInterface;
use InvalidArgumentException;

final class Product implements ProductInterface
{
    public function __construct(
        private readonly string $name,
        private Price $unitPrice,
        private int $availableQuantity
    ) {
        strlen($name) === 0 && throw new InvalidArgumentException();

        $unitPrice->dollar < 0 && throw new InvalidArgumentException();

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
}
