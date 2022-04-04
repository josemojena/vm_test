<?php

namespace VmApp\Domain\Model\CoinStock;


use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;

class Coin
{
    private float $value;

    public function __construct(float $value)
    {
        if ($value == 0) {
            throw  new InvalidArgumentException("value must be greater than zero");
        }
        $this->setValue($value);
    }

    public static function fromValue(float $value)
    {
        return new self($value);
    }

    /**
     * @return float
     */
    public function value(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return void
     */
    private function setValue(float $value)
    {
        $this->value = $value;
    }

    /**
     * @param Coin $coin
     * @return bool
     */
    #[Pure] public function equals(Coin $coin): bool
    {
        return $this->value == $coin->value();
    }

    #[Pure] public function __toString(): string
    {
        return "{$this->value()}";
    }
}