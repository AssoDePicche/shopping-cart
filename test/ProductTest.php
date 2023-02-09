<?php

namespace Test;

use Cart\Product;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ValueObject\ID;
use ValueObject\Price;

final class ProductTest extends TestCase
{
    public function test_empty_name_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Product(new ID, '', Price::from(4990), 12);
    }

    public function test_available_quantity_smaller_than_zero_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Product(new ID, 'Kubidai Hikiukenin', Price::from(4990), -1);
    }

    public function test_decrease_an_amount_greater_than_available_quantity_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = new Product(new ID, 'Kubidai Hikiukenin', Price::from(4990), 2);

        $product->changeAvailableQuantity(3);
    }
}
