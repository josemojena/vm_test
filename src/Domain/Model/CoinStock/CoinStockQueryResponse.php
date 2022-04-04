<?php

namespace VmApp\Domain\Model\CoinStock;

class CoinStockQueryResponse
{
    /**
     * @var CoinStock[]
     */
    private array $coinStocks;

    public function __construct(array $coinStocks)
    {
        $this->coinStocks = $coinStocks;
    }

    public function __toString(): string
    {
        if (count($this->coinStocks) == 0) {
            return "Coin stock empty";
        }
        $coinStockDto = array_map(function ($item) {
            return sprintf("%d(%s)", $item->amount(), $item->coin());
        }, $this->coinStocks);

        return implode("\n", $coinStockDto);
    }
}