<?php

namespace Test;

use Cart\CartItem;
use Cart\Product;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ValueObject\ID;
use ValueObject\Price;

final class CartItemTest extends TestCase
{
    public function test_a_quantity_greater_than_available_quantity_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = new Product(new ID, 'Kubidai Hikiukenin', Price::from(4990), 12);

        new CartItem($product, 20);
    }

    public function test_a_quantity_equal_to_zero_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = new Product(new ID, 'Kubidai Hikiukenin', Price::from(4990), 12);

        new CartItem($product, 0);
    }

    public function test_a_quantity_smaller_than_zero_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = new Product(new ID, 'Kubidai Hikiukenin', Price::from(4990), 12);

        new CartItem($product, -10);
    }

    public function test_increase_an_amount_greater_than_available_quantity_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = new Product(new ID, 'Kubidai Hikiukenin', Price::from(4990), 12);

        $item = new CartItem($product, 12);

        $item->changeQuantity(1);
    }

    public function test_decrease_an_amount_greater_than_available_quantity_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = new Product(new ID, 'Kubidai Hikiukenin', Price::from(4990), 12);

        $item = new CartItem($product, 2);

        $item->changeQuantity(-3);
    }
}
