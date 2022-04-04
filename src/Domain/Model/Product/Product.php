<?php

namespace VmApp\Domain\Model\Product;

use VmApp\Domain\ProductName;
use VmApp\Domain\strig;

class Product
{

    /**
     * @var string Unique identifier for product
     */
    private ProductId $id;
    /**
     * @var string Name of the product
     */
    private string $name;
    /**
     * @var Money Current price of the product
     */
    private Money $price;
    /**
     * @var int Amount of product
     */
    private int $availableStock;
    /**
     * @var string Identify the product on the vending-machine(button-product)
     */
    private string $selector;

    public function __construct(ProductId $id, string $name, Money $price, string $selector, int $availableStock)
    {
        $this->setId($id);
        $this->setPrice($price);
        $this->setName($name);
        $this->setSelector($selector);
        $this->setQuantity($availableStock);
    }

    /**
     * Allow to buy a product for a given amount of money
     * @param Money $totalMoney
     * @return bool
     */
    public function isEnoughMoneyForBuy(Money $totalMoney): bool
    {
        return $this->price()->greaterOrEqualThan($totalMoney);
    }

    /**
     * @return ProductId
     */
    public function id(): ProductId
    {
        return $this->id;
    }

    /**
     * @param ProductId $id
     * @return void
     */
    private function setId(ProductId $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Money
     */
    public function price(): Money
    {
        return $this->price;
    }

    /**
     * @param Money $price
     */
    private function setPrice(Money $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    private function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $selector
     */
    public function setSelector(string $selector): void
    {
        $this->selector = $selector;
    }

    /**
     * @return string
     */
    public function selector(): string
    {
        return $this->selector;
    }

    /**
     * @return int
     */
    public function quantity(): int
    {
        return $this->availableStock;
    }

    /**
     * @param int $quantity
     */
    private function setQuantity(int $quantity): void
    {
        $this->availableStock = $quantity;
    }

    /**
     * @return void
     */
    public function decreaseStock(int $howManyReduce = 1)
    {
        $quantity = $this->quantity() - $howManyReduce;
        if ($quantity < 0) {
            $quantity = 0;
        }
        $this->setQuantity($quantity);
    }

    /**
     * Whether a product  is available
     * @return bool
     */
    public function existence(): bool
    {
        return $this->quantity() > 0;
    }
}