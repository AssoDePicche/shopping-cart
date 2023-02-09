<?php

namespace ValueObject\Contract;

interface PriceInterface
{
    public static function from(int $cent): self;
}
