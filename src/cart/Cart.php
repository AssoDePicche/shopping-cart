<?php

declare(strict_types=1);

namespace Cart;

use Cart\Contract\CartInterface;
use Cart\Contract\CartItemInterface;
use Serialization\Serializable;
use WeakMap;

final class Cart extends Serializable implements CartInterface
{
    private WeakMap $items;

    public function __construct()
    {
        $this->items = new WeakMap;
    }

    public function add(CartItemInterface $item): void
    {
        if (!$this->contains($item)) {
            $this->items->offsetSet($item->getProduct()->getID(), $item);

            return;
        }

        $obj = $this->items->offsetGet($item->getProduct()->getID());

        $obj->changeQuantity($item->getQuantity());
    }

    public function remove(CartItemInterface $item, int $quantity): void
    {
        if (!$this->contains($item)) {
            return;
        }

        $quantity *= -1;

        $obj = $this->items->offsetGet($item->getProduct()->getID());

        $obj->changeQuantity($quantity);

        if ($obj->getQuantity() === 0) {
            $this->items->offsetUnset($obj->getProduct()->getID());
        }
    }

    public function removeAll(CartItemInterface $item): void
    {
        $this->items->offsetUnset($item->getProduct()->getID());
    }

    public function contains(CartItemInterface $item): bool
    {
        return $this->items->offsetExists($item->getProduct()->getID());
    }

    public function count(CartItemInterface $item): int
    {
        if (!$this->contains($item)) {
            return 0;
        }

        $obj = $this->items->offsetGet($item->getProduct()->getID());

        return $obj->getQuantity();
    }

    public function clear(): void
    {
        $this->items = new WeakMap;
    }

    public function getTotal(): float
    {
        $total = 0;

        foreach ($this->items as $key => $value) {
            $total += $value->getSubtotal();
        }

        return $total;
    }

    public function getSize(): int
    {
        $size = 0;

        foreach ($this->items as $key => $value) {
            $size += $value->getQuantity();
        }

        return $size;
    }

    public function toArray(): array
    {
        $items = [];

        foreach ($this->items as $key => $value) {
            $items[] = $value;
        }

        return [
            'items' => $items,
            'size' => $this->getSize(),
            'total' => $this->getTotal()
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->items = new WeakMap;

        foreach ($data['items'] as $key => $value) {
            $this->items->offsetSet($key, $value);
        }
    }
}
