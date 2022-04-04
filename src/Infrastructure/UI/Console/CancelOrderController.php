<?php

namespace VmApp\Infrastructure\UI\Console;

use VmApp\Application\Order\CancelOrderCommandHandler;
use VmApp\Domain\Model\Sales\CancelOrderResponse;
use VmApp\Domain\Model\Sales\CreateOrderCommand;

class CancelOrderController
{
    public function __construct(private CancelOrderCommandHandler $cancelOrderCommandHandler)
    {
    }

    public function execute(CreateOrderCommand $command): CancelOrderResponse
    {
        return $this->cancelOrderCommandHandler->handle($command);
    }
}