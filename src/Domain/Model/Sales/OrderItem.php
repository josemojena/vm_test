<?php

namespace VmApp\Domain\Model\Sales;

/**
 * Simple orderItem
 */
class OrderItem
{
    private string $productId;
    private string $productCode;
    private string $productName;
    private int $quantity;
    private float $cost;

    /**
     * @throws \Exception
     */
    public function __construct(string $productId, string $productName, string $productCode, float $cost, int $quantity = 1)
    {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->productCode = $productCode;
        $this->cost = $cost;
        $this->quantity = $quantity;
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