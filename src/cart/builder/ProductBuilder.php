<?php

declare(strict_types=1);

namespace Cart\Builder;

use Cart\Contract\ProductInterface;
use Cart\Product;
use ValueObject\ID;
use ValueObject\Price;

final class ProductBuilder
{
    public static function getProduct(string $name, int $cent, int $availableQuantity): ProductInterface
    {
        return new Product(
            new ID,
            $name,
            Price::from($cent),
            $availableQuantity
        );
    }
}
