<?php

declare(strict_types=1);

namespace Test\Cart;

use Cart\Builder\ProductBuilder;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    public function test_empty_name_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        ProductBuilder::build('', 4990, 12);
    }

    public function test_available_quantity_smaller_than_zero_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        ProductBuilder::build('Kubidai Hikiukenin', 4990, -1);
    }

    public function test_decrease_an_amount_greater_than_available_quantity_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = ProductBuilder::build('Kubidai Hikiukenin', 4990, 2);

        $product->changeAvailableQuantity(3);
    }
}
