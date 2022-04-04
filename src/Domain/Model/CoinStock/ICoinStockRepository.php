<?php

namespace VmApp\Domain\Model\CoinStock;

interface ICoinStockRepository
{
  public function insertMoney(Coin $coin);

    /**
     * @return CoinStock[]
     */
  public function stock();

}