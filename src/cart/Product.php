<?php

declare(strict_types=1);

namespace Cart;

use Cart\Contract\ProductInterface;
use InvalidArgumentException;
use Serialization\Serializable;
use ValueObject\ID;
use ValueObject\Price;

final class Product extends Serializable implements ProductInterface
{
    public function __construct(
        private readonly ID $id,
        private readonly string $name,
        private readonly Price $price,
        private int $availableQuantity
    ) {
        strlen($name) === 0 && throw new InvalidArgumentException();

        $availableQuantity < 0 && throw new InvalidArgumentException();
    }

    public function getID(): ID
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): Price
    {
        return $this->price;
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
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'available quantity' => $this->availableQuantity
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->id = $data['id'];

        $this->name = $data['name'];

        $this->price = $data['price'];

        $this->availableQuantity = $data['available quantity'];
    }
}
