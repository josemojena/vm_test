<?php

namespace VmApp\Domain\Model\Sales;

use VmApp\Domain\Model\CoinStock\Coin;

class CancelOrderResponse
{
    /**
     * @var Coin[]
     */
    private array $coins;

    public function __construct(array $coins = [])
    {
        $this->coins = $coins;

    }

    public function __toString(): string
    {
        return implode(",", $this->coins);
    }
}