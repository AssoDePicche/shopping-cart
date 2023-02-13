<?php

declare(strict_types=1);

namespace Cart\Builder;

use Cart\CartItem;
use Cart\Contract\CartItemInterface;
use Cart\Contract\ProductInterface;

final class CartItemBuilder
{
    public static function build(ProductInterface $item, int $quantity): CartItemInterface
    {
        return new CartItem($item, $quantity);
    }
}
