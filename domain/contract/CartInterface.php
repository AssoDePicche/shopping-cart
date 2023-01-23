<?php

namespace Cart\Contract;

interface CartInterface
{
    public function add(CartItemInterface $item): void;

    public function remove(CartItemInterface $item, int $amount): void;

    public function removeAll(CartItemInterface $item): void;

    public function contains(CartItemInterface $item): bool;

    public function count(CartItemInterface $item): int;

    public function clear(): void;

    public function getTotal(): float;

    public function getSize(): int;
}
