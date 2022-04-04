<?php

namespace VmApp\Infrastructure\UI\Console;

use VmApp\Application\Product\CoinStockQuery;
use VmApp\Application\Product\CoinStockQueryHandler;

class ConsultingCoinStockController
{
    public function __construct(private CoinStockQueryHandler $productQueryHandler)
    {
    }

    public function execute(CoinStockQuery $command): CancelOrderResponse
    {
        return $this->cancelOrderCommandHandler->handle($command);
    }
}