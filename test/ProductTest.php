<?php

namespace Test;

use Cart\Product;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    public function test_empty_name_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Product('', 29.99, 12);
    }

    public function test_unit_price_smaller_than_zero_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Product('Book', -1, 12);
    }

    public function test_available_quantity_smaller_than_zero_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Product('Book', 29.99, -1);
    }

    public function test_decrease_an_amount_greater_than_available_quantity_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = new Product('Book', 29.99, 2);

        $product->decreaseAvailableQuantity(3);
    }
}
