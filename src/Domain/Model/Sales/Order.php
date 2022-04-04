<?php

namespace VmApp\Domain\Model\Sales;


use VmApp\Domain\Model\Product\Money;

class Order
{
    private string $productId;
    private string $productCode;
    private string $productName;
    private int $quantity;
    private float $cost;
    private OrderStatus $status;

    /**
     * @throws \Exception
     */
    public function __construct(string $productId, string $productName, string $productCode, float $cost, float $balance, int $quantity = 1)
    {

        if ($cost > $balance) {
            throw new NotEnoughMoneyException();
        }
        $this->productId = $productId;
        $this->productName = $productName;
        $this->productCode = $productCode;
        $this->cost = $cost;
        $this->quantity = $quantity;
    }
    private function setStatus($status)
    {
        $this->status = $status;
    }

    public function confirm()
    {
        $this->setStatus(OrderStatus::confirmed);
    }

    public function cancel()
    {
        $this->setStatus(OrderStatus::canceled);
    }

    /**
     * @return string
     */
    public function productId(): string
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function productCode(): string
    {
        return $this->productCode;
    }

    /**
     * @return string
     */
    public function productName(): string
    {
        return $this->productName;
    }

    /**
     * @return int
     */
    public function quantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return float
     */
    public function cost(): float
    {
        return $this->cost;
    }
}