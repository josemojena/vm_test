<?php

namespace VmApp\Domain\Model\Sales;

use VmApp\Domain\Model\CoinStock\CoinStockId;

class SalesCoinStock
{
    public function __construct(private CoinStockId $coinStockId, private float $coinValue, private int $amount)
    {
    }

    /**
     * @return CoinStockId
     */
    public function coinStockId(): CoinStockId
    {
        return $this->coinStockId;
    }

    /**
     * @return int
     */
    public function amount(): int
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function coinValue(): float
    {
        return $this->coinValue;
    }
}