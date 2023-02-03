<?php

namespace Cart;

use Cart\Contract\CartItemInterface;
use Cart\Contract\ProductInterface;
use InvalidArgumentException;
use Util\Serializable;

final class CartItem extends Serializable implements CartItemInterface
{
    public function __construct(
        private readonly ProductInterface $product,
        private int $quantity
    ) {
        $quantity <= 0 && throw new InvalidArgumentException();

        $this->product->changeAvailableQuantity($quantity);
    }

    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getSubtotal(): float
    {
        return $this->quantity * $this->product->getPrice();
    }

    public function changeQuantity(int $quantity): void
    {
        $this->quantity + $quantity < 0 && throw new InvalidArgumentException();

        $this->quantity += $quantity;

        $this->product->changeAvailableQuantity($quantity);
    }

    public function toArray(): array
    {
        return [
            'product' => $this->product,
            'quantity' => $this->quantity,
            'subtotal' => $this->getSubtotal()
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->product = $data['product'];

        $this->quantity = $data['quantity'];
    }
}
