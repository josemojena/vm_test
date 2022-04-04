<?php

namespace VmApp\Domain\Model\Sales;

interface IOrderRepository
{
   public function add(Order $order);
}