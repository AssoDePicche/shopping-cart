<?php

namespace Cart\Contract;

interface CartItemInterface
{
    public function getProduct(): ProductInterface;

    public function getQuantity(): int;

    public function getSubtotal(): float;

    public function changeQuantity(int $amount): void;
}
