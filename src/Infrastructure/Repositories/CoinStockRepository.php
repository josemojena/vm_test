<?php

namespace VmApp\Infrastructure\Repositories;

use VmApp\Domain\Model\CoinStock\Coin;
use VmApp\Domain\Model\CoinStock\ICoinStockRepository;
use VmApp\Infrastructure\Database;

class CoinStockRepository implements ICoinStockRepository
{


    public function __construct(private Database\IDatabase $storage)
    {
    }

    public function insertMoney(Coin $coin)
    {
        $this->storage->save($coin);
    }

    public function stock()
    {
        return $this->storage->getCoinsStock();
    }
}