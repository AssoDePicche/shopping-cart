<?php

namespace Cart;

use Cart\Contract\ProductInterface;
use InvalidArgumentException;
use Util\Serializable;

final class Product extends Serializable implements ProductInterface
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

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'price' => $this->unitPrice,
            'available quantity' => $this->availableQuantity
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->name = $data['name'];

        $this->unitPrice = $data['price'];

        $this->availableQuantity = $data['available quantity'];
    }
}
