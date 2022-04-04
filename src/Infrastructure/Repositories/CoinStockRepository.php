<?php

namespace VmApp\Infrastructure\Repositories;

use VmApp\Domain\Model\CoinStock\Coin;
use VmApp\Domain\Model\CoinStock\CoinStock;
use VmApp\Domain\Model\CoinStock\ICoinStockRepository;
use VmApp\Infrastructure\Database;

class CoinStockRepository implements ICoinStockRepository
{


    public function __construct(private Database\IDatabase $storage)
    {
    }


    public function stock(): array
    {
        return $this->storage->getCoinsStock();
    }

    public function update(CoinStock $coinStock)
    {
        $this->storage->updateCoinStock($coinStock);
    }
}