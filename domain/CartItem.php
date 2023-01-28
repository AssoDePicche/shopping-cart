<?php

namespace Cart;

use Cart\Contract\CartItemInterface;
use Cart\Contract\ProductInterface;
use InvalidArgumentException;
use JsonSerializable;

final class CartItem implements CartItemInterface, JsonSerializable
{
    public function __construct(
        private readonly ProductInterface $product,
        private int $quantity
    ) {
        $quantity <= 0 && throw new InvalidArgumentException();

        $this->product->decreaseAvailableQuantity($quantity);
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
        return $this->quantity * $this->product->getUnitPrice();
    }

    public function increaseQuantity(int $amount = 1): void
    {
        $amount <= 0 && throw new InvalidArgumentException();

        $this->quantity + $amount > $this->product->getAvailableQuantity() && throw new InvalidArgumentException();

        $this->quantity += $amount;
    }

    public function decreaseQuantity(int $amount = 1): void
    {
        $amount <= 0 && throw new InvalidArgumentException();

        $this->quantity - $amount < 0 && throw new InvalidArgumentException();

        $this->quantity -= $amount;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'product' => $this->product,
            'quantity' => $this->quantity,
            'subtotal' => $this->getSubtotal()
        ];
    }
}
