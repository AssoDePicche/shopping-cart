<?php

namespace Cart\Contract;

interface ProductInterface
{
    public function getName(): string;

    public function getUnitPrice(): float;

    public function getAvailableQuantity(): int;

    public function decreaseAvailableQuantity(int $amount = 1): void;
}
