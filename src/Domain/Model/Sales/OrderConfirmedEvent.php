<?php

namespace VmApp\Domain\Model\Sales;

use Symfony\Contracts\EventDispatcher\Event;
use VmApp\Domain\Model\Product\ProductId;

final class OrderConfirmedEvent extends Event
{
    public const NAME = 'order.confirmed';
    public function __construct(protected ProductId $productId)
    {
    }
    public function productId(): ProductId
    {
        return $this->productId;
    }
}