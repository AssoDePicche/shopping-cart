<?php

namespace Cart\Contract;

interface ProductInterface
{
    public function getName(): string;

    public function getPrice(): float;

    public function getAvailableQuantity(): int;

    public function changeAvailableQuantity(int $quantity): void;
}
