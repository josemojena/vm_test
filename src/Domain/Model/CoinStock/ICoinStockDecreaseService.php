<?php

namespace VmApp\Domain\Model\CoinStock;

interface ICoinStockDecreaseService
{
    /**
     * @param Coin[] $coin
     * @return mixed
     */
    public function decrease(array $coin);
}