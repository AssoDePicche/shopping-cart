<?php

namespace Cart;

use Cart\Contract\ProductInterface;
use InvalidArgumentException;
use Util\Serializable;

final class Product extends Serializable implements ProductInterface
{
    public function __construct(
        private readonly string $name,
        private Price $price,
        private int $availableQuantity
    ) {
        strlen($name) === 0 && throw new InvalidArgumentException();

        $availableQuantity < 0 && throw new InvalidArgumentException();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price->dollar;
    }

    public function getAvailableQuantity(): int
    {
        return $this->availableQuantity;
    }

    public function changeAvailableQuantity(int $quantity): void
    {
        $this->availableQuantity - $quantity < 0 && throw new InvalidArgumentException();

        $this->availableQuantity -= $quantity;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'available quantity' => $this->availableQuantity
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->name = $data['name'];

        $this->price = $data['price'];

        $this->availableQuantity = $data['available quantity'];
    }
}
