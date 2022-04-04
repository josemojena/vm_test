<?php

namespace VmApp\Application\Order;

use JetBrains\PhpStorm\Pure;
use VmApp\Domain\Model\Sales\CancelOrderCommand;
use VmApp\Domain\Model\Sales\CancelOrderResponse;

class CancelOrderCommandHandler
{

    #[Pure] public function handle(CancelOrderCommand $request)
    {
        //At this moment nothing to do just return coins back
        return new CancelOrderResponse($request->coins());
    }
}