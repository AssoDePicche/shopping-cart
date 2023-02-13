<?php

namespace ValueObject\Contract;

interface IdentifierInterface
{
    public static function from(string $id): self;
}
