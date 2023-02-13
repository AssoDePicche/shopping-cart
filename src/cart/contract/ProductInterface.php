<?php

namespace Cart\Contract;

use ValueObject\ID;
use ValueObject\Price;

interface ProductInterface
{
    public function getID(): ID;

    public function getName(): string;

    public function getPrice(): Price;

    public function getAvailableQuantity(): int;

    public function changeAvailableQuantity(int $quantity): void;
}
