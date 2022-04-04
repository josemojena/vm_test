<?php

namespace VmApp\Domain\Model\Sales;

use VmApp\Domain\Model\CoinStock\Coin;

class CreateOrderCommand
{
    /**
     * @var string
     */
    private string $productCode;
    /**
     * @var Coin[]
     */
    private array $coins;

    public function __construct(string $productCode, array $coins)
    {
        $this->productCode = $productCode;
        $this->coins = $coins;
    }


    /**
     * @return Coin[]
     */
    public function coins(): array
    {
        return $this->coins;
    }

    /**
     * @return string
     */
    public function productCode(): string
    {
        return $this->productCode;
    }

}