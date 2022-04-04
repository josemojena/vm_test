<?php

namespace VmApp\Application\CoinsStock\Queries;

use VmApp\Domain\Model\CoinStock\CoinStockQueryResponse;
use VmApp\Domain\Model\CoinStock\ICoinStockRepository;


class CoinStockQueryHandler
{
    public function __construct(private ICoinStockRepository $coinStockRepository)
    {

    }

    public function handle(CoinStockQuery $query): CoinStockQueryResponse
    {
        $coinsStock = $this->coinStockRepository->stock();
        return new CoinStockQueryResponse($coinsStock);
    }
}