<?php

namespace Cart\Contract;

use ValueObject\ID;

interface ProductInterface
{
    public function getID(): ID;

    public function getName(): string;

    public function getPrice(): float;

    public function getAvailableQuantity(): int;

    public function changeAvailableQuantity(int $quantity): void;
}
