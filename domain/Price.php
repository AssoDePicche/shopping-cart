<?php

namespace Cart;

use Cart\Contract\PriceInterface;
use InvalidArgumentException;
use JsonSerializable;
use Util\Contract\ArraySerializable;
use Util\Trait\SerializableTrait;

final readonly class Price implements PriceInterface, JsonSerializable, ArraySerializable
{
    use SerializableTrait;

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

    public function toArray(): array
    {
        return [
            'cent' => $this->cent,
            'dollar' => $this->dollar,
            'formatted' => $this->formatted
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->cent = $data['cent'];

        $this->dollar = $data['dollar'];

        $this->formatted = $data['formatted'];
    }
}
