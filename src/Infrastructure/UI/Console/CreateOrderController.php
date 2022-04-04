<?php

namespace VmApp\Infrastructure\UI\Console;

use VmApp\Application\Order\CreateOrderCommandHandler;
use VmApp\Domain\Model\Sales\CreateOrderCommand;
use VmApp\Domain\Model\Sales\GetItemResponse;
use VmApp\Domain\Model\Sales\NotEnoughMoneyException;
use VmApp\Domain\Model\Sales\OutOfStockException;

class CreateOrderController
{
    public function __construct(private CreateOrderCommandHandler $orderCommandHandler)
    {
    }

    public function execute(CreateOrderCommand $command): GetItemResponse|int|string
    {
        try {
            $echoResponse = $this->orderCommandHandler->handle($command);
        } catch (OutOfStockException) {
            $echoResponse = sprintf("Error: product `%s` out of stock\n", $command->productCode());
        } catch (NotEnoughMoneyException) {
            $echoResponse = sprintf("Error: not enough money to buy the product `%s`\n", $command->productCode());
        } catch (\Exception $exception) {
            $echoResponse = sprintf("General error: `%s`\n", $exception->getMessage());
        }
        return $echoResponse;
    }
}