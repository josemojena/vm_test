<?php

namespace VmApp\Domain\Model\Product;

use JetBrains\PhpStorm\Pure;


class Money
{
    private float $value;

    //other field here...

    /**
     * @throws \Exception
     */
    public function __construct(float $value)
    {
        if ($value < 0) {
            throw new \Exception("`$value` must be positive");
        }
        $this->value = $value;
    }

    /**
     * @param Coins[] $coins
     * @return Money
     * @throws \Exception
     */
    public static function fromCoins(array $coins): Money
    {

        $total = 0.0;
        foreach ($coins as $coin) {
            $total += $coin->value();
        }
        return new self($total);
    }


    /**
     * @throws \Exception
     */
    public static function fromValue(float $value): Money
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

    #[Pure] public function __toString(): string
    {
        return "{$this->value()}";
    }

    #[Pure] public function greaterOrEqualThan(Money $totalMoney): bool
    {
        return $this->equals($totalMoney) || $this->greather($totalMoney);
    }

    /**
     * @throws \Exception
     */
    public function subtract(Money $moneyToSubtract): Money
    {
        $_value = $this->value() - $moneyToSubtract->value();
        return new self(sprintf("%.2f", $_value));
    }

    /**
     * @throws \Exception
     */
    public function add(Money $moneyToAdd): Money
    {
        $_value = $this->value() + $moneyToAdd->value();
        return new self(sprintf("%.2f", $_value));
    }

    #[Pure] public function equals(Money $toCompare): bool
    {
        return $this->value() == $toCompare->value();
    }

    #[Pure] public function greather(Money $toCompare): bool
    {
        return $this->value() > $toCompare->value();
    }

    #[Pure] public function lower(Money $toCompare): bool
    {
        return $this->value() < $toCompare->value();
    }

    public function divideRest(Money $toDivide)
    {
        return new self(fmod($this->value(), $toDivide->value()));
    }

    public function divide(Money $toDivide)
    {
        return new self(fdiv($this->value(), $toDivide->value()));
    }
}