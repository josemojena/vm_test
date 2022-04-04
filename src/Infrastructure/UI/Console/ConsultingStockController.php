<?php

namespace VmApp\Infrastructure\UI\Console;

use VmApp\Application\Product\ProductQuery;
use VmApp\Application\Product\ProductQueryHandler;

class ConsultingStockController
{
    public function __construct(private ProductQueryHandler $productQueryHandler)
    {
    }

    public function execute(ProductQuery $command): CancelOrderResponse
    {
        return $this->cancelOrderCommandHandler->handle($command);
    }
}