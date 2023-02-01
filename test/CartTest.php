<?php

namespace Test;

use Cart\Cart;
use Cart\CartItem;
use Cart\Price;
use Cart\Product;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class CartTest extends TestCase
{
    public function test_cannot_repeat_products_in_cart(): void
    {
        $product1 = new Product('Kubidai Hikiukenin', Price::from(4990), 6);

        $product2 = new Product('Kubidai Hikiukenin', Price::from(4990), 6);

        $item1 = new CartItem($product1, 2);

        $item2 = new CartItem($product2, 2);

        $cart = new Cart;

        $cart->add($item1);

        $cart->add($item2);

        $this->assertEquals(4, $cart->count($item1));
    }

    public function test_remove_amount_smaller_than_one_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $product = new Product('Kubidai Hikiukenin', Price::from(4990), 6);

        $item = new CartItem($product, 4);

        $cart = new Cart;

        $cart->add($item);

        $cart->remove($item, -3);
    }

    public function test_remove_should_decrease_the_amount_of_product(): void
    {
        $product = new Product('Kubidai Hikiukenin', Price::from(4990), 6);

        $item = new CartItem($product, 4);

        $cart = new Cart;

        $cart->add($item);

        $cart->remove($item, 3);

        $this->assertEquals(1, $cart->count($item));
    }

    public function test_remove_all_should_remove_the_item_from_cart(): void
    {
        $product = new Product('Kubidai Hikiukenin', Price::from(4990), 12);

        $item = new CartItem($product, 3);

        $cart = new Cart;

        $cart->add($item);

        $cart->removeAll($item);

        $this->assertEquals(false, $cart->contains($item));
    }

    public function test_count_should_return_the_quantity_of_a_type_of_item(): void
    {
        $product = new Product('Kubidai Hikiukenin', Price::from(4990), 12);

        $item = new CartItem($product, 3);

        $cart = new Cart;

        $cart->add($item);

        $this->assertEquals(3, $cart->count($item));
    }

    public function test_clear_should_remove_all_items_from_cart(): void
    {
        $product = new Product('Kubidai Hikiukenin', Price::from(4990), 12);

        $product2 = new Product('Shin Kubidai Hikiukenin', Price::from(4990), 20);

        $item = new CartItem($product, 3);

        $item2 = new CartItem($product2, 18);

        $cart = new Cart;

        $cart->add($item);

        $cart->add($item2);

        $cart->clear();

        $this->assertEquals(0, $cart->getSize());
    }

    public function test_get_total_should_return_the_subtotal_of_all_items(): void
    {
        $product1 = new Product('Kubidai Hikiukenin', Price::from(4990), 5);

        $product2 = new Product('Shin Kubidai Hikiukenin', Price::from(4990), 5);

        $item1 = new CartItem($product1, 4);

        $item2 = new CartItem($product2, 2);

        $cart = new Cart;

        $cart->add($item1);

        $cart->add($item2);

        $this->assertEquals(299.40, $cart->getTotal());
    }

    public function test_get_size_should_return_the_quantity_of_all_items(): void
    {
        $product1 = new Product('Kubidai Hikiukenin', Price::from(4990), 6);

        $product2 = new Product('Shin Kubidai Hikiukenin', Price::from(4990), 6);

        $item1 = new CartItem($product1, 4);

        $item2 = new CartItem($product2, 2);

        $cart = new Cart;

        $cart->add($item1);

        $cart->add($item2);

        $this->assertEquals(6, $cart->getSize());
    }
}
