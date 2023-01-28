<?php

namespace Test;

use Cart\Price;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class PriceTest extends TestCase
{
    public function test_price_smaller_than_zero_should_throw_invalid_argument_exception(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Price(-1);
    }
}
