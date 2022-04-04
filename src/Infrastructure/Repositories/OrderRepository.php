<?php

namespace VmApp\Infrastructure\Repositories;


use VmApp\Domain\Model\Sales\IOrderRepository;
use VmApp\Domain\Model\Sales\Order;
use VmApp\Infrastructure\Database\IDatabase;


class OrderRepository implements IOrderRepository
{

    public function __construct(private IDatabase $database)
    {
    }

    public function add(Order $order)
    {
        $this->database->addOrder($order);
    }
}