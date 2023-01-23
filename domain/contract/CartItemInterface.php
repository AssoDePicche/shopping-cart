<?php

namespace Cart\Contract;

interface CartItemInterface
{
    public function getProduct(): ProductInterface;

    public function getQuantity(): int;

    public function getSubtotal(): float;

    public function increaseQuantity(int $amount = 1): void;

    public function decreaseQuantity(int $amount = 1): void;
}
