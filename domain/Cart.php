<?php

namespace Cart;

use Cart\Contract\CartInterface;
use Cart\Contract\CartItemInterface;
use SplObjectStorage;
use Util\Serializable;

final class Cart extends Serializable implements CartInterface
{
    private SplObjectStorage $items;

    public function __construct()
    {
        $this->items = new SplObjectStorage;
    }

    public function add(CartItemInterface $item): void
    {
        foreach ($this->items as $cartItem) {
            if ($cartItem->getProduct()->getName() === $item->getProduct()->getName()) {
                $cartItem->increaseQuantity($item->getQuantity());

                return;
            }
        }

        $this->items->attach($item);
    }

    public function remove(CartItemInterface $item, int $amount): void
    {
        foreach ($this->items as $cartItem) {
            if ($cartItem->getProduct()->getName() === $item->getProduct()->getName()) {
                $cartItem->decreaseQuantity($amount);
            }
        }
    }

    public function removeAll(CartItemInterface $item): void
    {
        $this->items->detach($item);
    }

    public function contains(CartItemInterface $item): bool
    {
        return $this->items->contains($item);
    }

    public function count(CartItemInterface $item): int
    {
        foreach ($this->items as $cartItem) {
            if ($cartItem->getProduct()->getName() === $item->getProduct()->getName()) {
                return $cartItem->getQuantity();
            }
        }

        return 0;
    }

    public function clear(): void
    {
        $this->items = new SplObjectStorage();
    }

    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item->getSubtotal();
        }

        return $total;
    }

    public function getSize(): int
    {
        $size = 0;

        foreach ($this->items as $item) {
            $size += $item->getQuantity();
        }

        return $size;
    }

    public function toArray(): array
    {
        $items = [];

        foreach ($this->items as $item) {
            $items[] = $item;
        }

        return [
            'items' => $items,
            'size' => $this->getSize(),
            'total' => $this->getTotal()
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->items = new SplObjectStorage;

        foreach ($data['items'] as $item) {
            $this->items->attach($item);
        }
    }
}
