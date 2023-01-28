<?php

namespace Cart\Contract;

interface PriceInterface
{
    public static function from(int $cent): self;
}
