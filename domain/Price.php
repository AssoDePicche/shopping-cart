<?php

namespace Cart;

use Cart\Contract\PriceInterface;
use InvalidArgumentException;

final readonly class Price implements PriceInterface
{
    public float $dollar;

    public string $formatted;

    public function __construct(public int $cent)
    {
        $cent < 0 && throw new InvalidArgumentException();

        $this->dollar = $cent / 100;

        $this->formatted = '$' . number_format($this->dollar, 2);
    }

    public static function from(int $cent): self
    {
        return new self($cent);
    }
}
