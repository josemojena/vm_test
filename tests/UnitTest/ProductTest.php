<?php

namespace UnitTest;

use PHPUnit\Framework\TestCase;
use VmApp\Domain\Model\Product\Money;
use VmApp\Domain\Model\Product\Product;
use VmApp\Domain\Model\Product\ProductId;

class ProductTest extends TestCase
{
    public function testDecreaseProductStockWasOk()
    {
        $product = new Product(id: new ProductId(), name: "Water", price: new Money(0.65), selector: "GET-WATER", availableStock: 5);
        $product->decreaseStock();
        self::assertEquals(4, $product->quantity());
    }
    public function testDecreaseProductStockIsZeroForNegativeValues()
    {
        $product = new Product(id: new ProductId(), name: "Water", price: new Money(0.65), selector: "GET-WATER", availableStock: 1);
        $product->decreaseStock(5);
        self::assertEquals(0, $product->quantity());
    }

}