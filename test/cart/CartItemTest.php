<?php

declare(strict_types=1);

namespace Test\Cart;

use Cart\Builder\CartItemBuilder;
use Cart\Builder\ProductBuilder;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class CartItemTest extends TestCase
{
    public function test_a_quantity_greater_than_available_quantity_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = ProductBuilder::build('Kubidai Hikiukenin', 4990, 12);

        CartItemBuilder::build($product, 20);
    }

    public function test_a_quantity_equal_to_zero_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = ProductBuilder::build('Kubidai Hikiukenin', 4990, 12);

        CartItemBuilder::build($product, 0);
    }

    public function test_a_quantity_smaller_than_zero_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = ProductBuilder::build('Kubidai Hikiukenin', 4990, 12);

        CartItemBuilder::build($product, -10);
    }

    public function test_increase_an_amount_greater_than_available_quantity_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = ProductBuilder::build('Kubidai Hikiukenin', 4990, 12);

        $item = CartItemBuilder::build($product, 12);

        $item->changeQuantity(1);
    }

    public function test_decrease_an_amount_greater_than_available_quantity_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = ProductBuilder::build('Kubidai Hikiukenin', 4990, 12);

        $item = CartItemBuilder::build($product, 2);

        $item->changeQuantity(-3);
    }
}
