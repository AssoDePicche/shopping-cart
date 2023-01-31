<?php

namespace Cart\Contract;

interface ProductInterface
{
    public function getName(): string;

    public function getUnitPrice(): float;

    public function getAvailableQuantity(): int;

    public function changeAvailableQuantity(int $amount): void;
}
