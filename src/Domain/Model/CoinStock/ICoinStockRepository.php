<?php

namespace VmApp\Domain\Model\CoinStock;

interface ICoinStockRepository
{
    /**
     * @return CoinStock[]
     */
    public function stock();

    /**
     * @param int $amount
     * @return mixed
     */
    public function update(CoinStock $coinStock);

}