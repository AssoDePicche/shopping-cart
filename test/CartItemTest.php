<?php

namespace Test;

use Cart\CartItem;
use Cart\Price;
use Cart\Product;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class CartItemTest extends TestCase
{
    public function test_a_quantity_greater_than_available_quantity_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = new Product('Book', new Price(2999), 12);

        new CartItem($product, 20);
    }

    public function test_a_quantity_equal_to_zero_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = new Product('Book', new Price(2999), 12);

        new CartItem($product, 0);
    }

    public function test_a_quantity_smaller_than_zero_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = new Product('Book', new Price(2999), 12);

        new CartItem($product, -10);
    }

    public function test_increase_an_amount_greater_than_available_quantity_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = new Product('Book', new Price(2999), 12);

        $item = new CartItem($product, 12);

        $item->increaseQuantity();
    }

    public function test_decrease_an_amount_greater_than_available_quantity_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = new Product('Book', new Price(2999), 12);

        $item = new CartItem($product, 2);

        $item->decreaseQuantity(3);
    }

    public function test_increase_amount_smaller_than_one_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = new Product('Book', new Price(2999), 12);

        $item = new CartItem($product, 2);

        $item->increaseQuantity(-1);
    }

    public function test_decrease_amount_smaller_than_one_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = new Product('Book', new Price(2999), 12);

        $item = new CartItem($product, 2);

        $item->decreaseQuantity(-1);
    }
}
